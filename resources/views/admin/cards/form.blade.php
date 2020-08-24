<div class="row">
    <label for="image" class="col">Image</label>
</div>
<div class="row form-group">
    <div class="col-6">
        <div class="custom-file">
            <input type="file" name='image' class="custom-file-input" id="image">
            <label class="custom-file-label" for="image">Choose file...</label>
        </div>
    </div>
</div>

<div class="row">

</div>
<div class="form-group row">
    <div class="col-6">
        <label for="average_time">Average time</label>
        <input type="text" value="{{old('average_time') ?? $card->average_time}}"
               class="form-control" name="average_time" placeholder="Average time" id="average_time">

    </div>
</div>

<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="difficulty">Difficulty</label>
            <select id="difficulty" name="difficulty" class="form-control">
                @foreach(\App\Models\Card::DIFFICULTY as $diff)
                    <option @if($card->difficulty == $diff) selected @endif value="{{$diff}}">{{$diff}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <label for="title" class="col">Title</label>
</div>
<div class="form-group row">
    <div class="col">
        <input id="title" type="text" value="{{old('content.ru.title') ?? optional($card->getContent('ru'))->title}}"
               class="form-control" name="content[ru][title]" placeholder="Title ru">
    </div>
    <div class="col">
        <input type="text" value="{{old('content.en.title') ?? optional($card->getContent('en'))->title}}"
               class="form-control" name="content[en][title]" placeholder="Title en">
    </div>
</div>

<div class="row">
    <label class="col" for="question">Question</label>
</div>
<div class="form-group row">
    <div class="col">
        <textarea id="question" class="form-control" rows="10" name="content[ru][question]"
                  placeholder="Question ru">{{old('content.ru.question') ?? optional($card->getContent('ru'))->question}}</textarea>
    </div>
    <div class="col">
        <textarea class="form-control" rows="10" name="content[en][question]"
                  placeholder="Question en">{{old('content.en.question') ?? optional($card->getContent('en'))->question}}</textarea>
    </div>
</div>

<div class="row">
    <label class="col" for="answer">Answer</label>
</div>
<div class="form-group row">
    <div class="col">
        <textarea id="answer" class="form-control" rows="10" name="content[ru][answer]"
                  placeholder="Answer ru">{{old('content.ru.answer') ?? optional($card->getContent('ru'))->answer}}</textarea>
    </div>
    <div class="col">
        <textarea class="form-control" rows="10" name="content[en][answer]"
                  placeholder="Answer en">{{old('content.en.answer') ?? optional($card->getContent('en'))->answer}}</textarea>
    </div>
</div>

