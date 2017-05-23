<form id="add" method="post" action="/posts" class="add-game col-sm-offset-3 col-sm-6 col-xs-12">
    {{ csrf_field() }}
    <div class="fieldset">
        <div class="tab add">Add</div>
        <div class="field"><label for="">Title</label><input type="text" name="title" placeholder="Some title"></div>
        <div class="field">
            <div class="upload">
                <span>Add image/gif</span>
                <input type="file" name="image" accept="image/*">
            </div>
        </div>
        <div class="field">
            <label for="">Youtube</label>
            <span>
                <span class="label">http://</span>
                <input type="text" name="youTube">
            </span>
        </div>
        <div class="field">
            <label for="">Embed code (twitch, oddshot etc.)</label>
            <input type="text" name="embeddedCode" placeholder="Some title">
        </div>
        <input type="submit" class="btn btn-go" value="Add now">
    </div>
</form>