<script src="http://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
<a id="test" class="foo" href="#">Test</a>



<script>

    $(document).ready(function(){

        var input = 'alla';
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

        console.log(true)

    });


</script>