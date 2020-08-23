<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="exampleFormControlFile1">Image</label>
            <input type="file" name='image' class="form-control-file" id="exampleFormControlFile1">
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col">
        <input type="text" value="{{old('content.ru.title') ?? optional($card->getContent('ru'))->title}}"
               class="form-control" name="content[ru][title]" placeholder="Title ru">
    </div>
    <div class="col">
        <input type="text" value="{{old('content.en.title') ?? optional($card->getContent('en'))->title}}"
               class="form-control" name="content[en][title]" placeholder="Title en">
    </div>
</div>


<div class="form-group row">
    <div class="col">
        <textarea class="form-control" rows="10" name="content[ru][description]"
                  placeholder="Description ru">{{old('content.ru.description') ?? optional($card->getContent('ru'))->description}}</textarea>
    </div>
    <div class="col">
        <textarea class="form-control" rows="10" name="content[en][description]"
                  placeholder="Description en">{{old('content.en.description') ?? optional($card->getContent('en'))->description}}</textarea>
    </div>
</div>

