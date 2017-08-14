<script src="http://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
<a id="test" class="foo" href="#">Test</a>

<body>
<ul class="list">
    <li  class="t">he</li>
    <li>he</li>
    <li>he</li>
    <li class="radio">he</li>
    <li class="t">he</li>
    <li>he</li>
</ul>
<ul class="list">
    <li>dkf</li>
    <li  class="t">dkf</li>
    <li>dkf</li>
    <li  class="t">dkf</li>
    <li class="t">dkf</li>
    <li>dkf</li>
</ul>
</body>




<script>

    $(document).ready(function(){

        $('.radio').on('click', function () {
            //alert('dfkl');
            var p = $(this).parents('.list');
            p.find('.t').css('color', 'red');
        });


        /*var input = 'alla';
        var words = input.split(' ');
        var characters = [];

        words.forEach(function(item){
            //console.log(item.split(''));
            var c = item.split('');
            c.forEach(function (character) {
                characters.push(character);
            })
        });

        for(var i = 0; i < characters.length; i++){
            if(characters[i] != characters[characters.length - i]){
                console.log(characters[1]);
            }
        }

        console.log(true)*/

        $('body').on('click', function(next) {

            var list = $('.list');

            list.queue('fading', function () {
                var self = this;
                $(this).fadeOut(1000);

                setTimeout(function() {
                    $(self).dequeue('fading')
                }, 3000)
            });

            list.queue('fading', function () {
                var self = this;
                $(this).fadeIn(1000);

                setTimeout(function() {
                    $(self).dequeue('fading')
                }, 3000)
            });

            list.dequeue('fading');

        })

    });


</script>
