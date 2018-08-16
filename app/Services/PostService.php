<?php


namespace App\Services;


use Alaouy\Youtube\Facades\Youtube;
use App\Entities\Post;
use App\Repositories\PostRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class PostService
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * PostsController constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param Request $request
     * @return Post
     */
    public function storePost(Request $request): Post
    {
        $timestamp = date('YmdHis');
        if (isset($request->image)) {
            $image = $request->file('image');
            list($width, $height) = getimagesize($image);
            $originalExtension = $image->getClientOriginalExtension();
        } else {
            $videoCode = Youtube::parseVidFromURL($request->youTube);
            $image = 'https://img.youtube.com/vi/' . $videoCode . '/maxresdefault.jpg';
            $originalExtension = substr($image, strpos($image, 'maxresdefault.') + 14);
            if (@getimagesize($image) === FALSE) {
                $image = 'https://img.youtube.com/vi/' . $videoCode . '/sddefault.jpg';
                $originalExtension = substr($image, strpos($image, 'sddefault.') + 10);
                if (@getimagesize($image) === FALSE) {
                    return redirect()->back()->withErrors(['message' => 'Change video or add image'])->withInput();
                }
            }
        }

        $fileNameMedium = $request->title . $timestamp . '.medium.' . $originalExtension;
        $location = public_path('uploads/' . $fileNameMedium);
        Image::make($image)->fit(config('image.medium_size'))->save($location);

        $fileNameMin = $request->title . $timestamp . '.min.' . $originalExtension;
        $location = public_path('uploads/' . $fileNameMin);
        Image::make($image)->resize(config('image.small_size'), config('image.small_size'))->save($location);

        $fileNameOriginal = $request->title . $timestamp . '.original.' . $originalExtension;
        if ($originalExtension == 'gif') {
            $fileName = $fileNameOriginal;
            $image->move('uploads', $fileNameOriginal);
        } else {
            if (isset($request->image)) {
                $fileName = $request->title . $timestamp . '.' . $originalExtension;
                $location = public_path('uploads/' . $fileName);
                Image::make($image)->fit(config('image.large_width'), $height)->save($location);
                $image->move('uploads', $fileNameOriginal);
            } else {
                $fileName = $request->title . $timestamp . '.' . $originalExtension;
                $location = public_path('uploads/' . $fileName);
                Image::make($image)->fit(config('image.large_width'), '720')->save($location);
            }
        }

        $post = $this->postRepository->create([
            'title' => $request->title,
            'image' => $fileName,
            'youTube' => $request->youTube,
            'embeddedCode' => $request->embeddedCode,
            'date' => Carbon::now(),
            'user_id' => Auth::user()->id
        ]);

        $this->postRepository->sync($post->id, 'games', $request->game);

        return $post;
    }
}