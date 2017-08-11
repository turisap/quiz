    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <input class="form-control question" id="question1" type="text" name="question[{{$i}}]" placeholder="Question #1" value="{{$questions[$i]['question']}}">
            </div>
        </div>
    </div>
    <div class="row radio-row">
        <div class="col-sm-5">
            <div class="form-group">
                <input class="form-control answer" id="answer1-1" type="text" name="answer1[{{$i}}]" placeholder="First answer" value="{{$questions[$i]['answer1']}}">
            </div>
        </div>
        <div class="col-sm-1">
            <div class="form-group">
                <input class="radio" type="radio" name="rightAnswer1{{$i}}" id="rightAnswer{{$i}}-1">
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <input class="form-control answer" id="answer1-2" type="text" name="answer2[{{$i}}]" placeholder="Second answer" value="{{$questions[$i]['answer2']}}">
            </div>
        </div>
        <div class="col-sm-1">
            <div class="form-group">
                <input class="radio" type="radio" name="rightAnswer2{{$i}}" id="rightAnswer{{$i}}-2">
            </div>
        </div>
    </div>
    <div class="row radio-row">
        <div class="col-sm-5">
            <div class="form-group">
                <input class="form-control answer" id="answer1-3" type="text" name="answer3[{{$i}}]" placeholder="Third answer" value="{{$questions[$i]['answer3']}}">
            </div>
        </div>
        <div class="col-sm-1">
            <div class="form-group">
                <input class="radio" type="radio" id="rightAnswer{{$i}}-3" name="rightAnswer3[{{$i}}]">
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <input class="form-control answer" type="text" id="answer1-4" name="answer4[{{$i}}]" placeholder="Fourth answer" value="{{$questions[$i]['answer4']}}">
            </div>
        </div>
        <div class="col-sm-1">
            <div class="form-group">
                <input class="radio" type="radio" id="rightAnswer{{$i}}-4" name="rightAnswer4[{{$i}}]">
            </div>
        </div>
    </div>

