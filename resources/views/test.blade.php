<script src="http://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
<a id="test" class="foo" href="#">Test</a>



<script>
    $(document).ready(function () {
        $('#test').click(function(){
            console.log($(this).hasClass('foof'));
        })
    })
</script>