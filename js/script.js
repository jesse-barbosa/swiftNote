
$(document).ready(function(){
    $('.deleteButton').click(function(){
        var postId = $(this).data('post-id');
        if(confirm("Tem certeza que deseja excluir essa anotação?")){
            $.ajax({
                url: 'deletarPost.php',
                type: 'post',
                data: {postId: postId},
                success:function(response){
                    location.reload();
                }
            });
        }
    });
});


$(document).ready(function(){
    $('.deleteButtonTrash').click(function(){
        var postId = $(this).data('post-id');
        if(confirm("Tem certeza que deseja excluir DEFINITIVAMENTE essa anotação?")){
            $.ajax({
                url: 'deletarPostTrash.php',
                type: 'post',
                data: {postId: postId},
                success:function(response){
                    location.reload();
                }
            });
        }
    });
});
