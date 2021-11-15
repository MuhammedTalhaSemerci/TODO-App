tinymce.init({
    selector: '#todoInsertContent'
});

tinymce.init({
    selector: '#todoUpdateContent'
});


function refresh()
{
    $.post("/?/todoList/refresh/",{},function(returnval){
        if(parseInt(returnval) !== null)
        {
            todoList = JSON.parse(returnval)
            var html = '';
            for(var i=0;i<todoList.length;i++)
            {
                /* The buttons that we use to control our todos */
                var arrangementBut = '<button  type="button" style="margin:2px;" class="arrangement-but" data-id="'+todoList[i].id+'" onclick="arrangementModalIndex(this);"><i class="fas fa-pen"></i></button>';
                var deleteBut = '<button style="margin:2px;" class="delete-but" data-id="'+todoList[i].id+'" onclick="todoDelete(this);"><i class="fas fa-trash-alt"></i></button>';
                
                var listName = (todoList[i].listName != null)? todoList[i].listName:"";

                /*  List date control start */
                var listDate = (todoList[i].listDate != null)? todoList[i].listDate.split("-"):"";
                var listDateHtml = (listDate.length === 3)? listDate[2]+"."+listDate[1]+"."+listDate[0]: "";
                var currentDate = new Date()
                bgColorControl = "";
                if(Date.parse(todoList[i].listDate) < Date.parse(currentDate) && todoList[i].listDate !== null)
                {
                    bgColorControl = "class='bgColorControlR'"
                }
                else
                {
                }
                /* List date control end */

                /* List Stress control start */
                var listStress = parseInt(todoList[i].listStress)
                listStressHtml="";
                switch (listStress) {
                    case 1:
                        listStressHtml = "class='bgColorControlG'";
                        break;
                    case 2:
                        listStressHtml = "class='bgColorControlY'";
                        break;
                    case 3:
                        listStressHtml = "class='bgColorControlR'";
                        break;
                    default:
                        break;
                }
                /* List Stress control end */
                
                html += '<tr '+bgColorControl+'><td>'+arrangementBut+deleteBut+'</td><td>'+listName+'</td><td>'+listDateHtml+'</td><td><div '+listStressHtml+'></div></td></tr>';
            }
            $("#todo-list-body").html(html);
          
        }
    }).fail(function(){
        alert("İşlem sırasında bir hata oldu.")
    })
}


function todoInsert()
{
    var listName = $("#todoInsertTitle").val()
    var listDate = $("#todoInsertDate").val()
    var listContent = tinymce.get("todoInsertContent").getContent()
    var listStress = $("#todoInsertStress").val()
    
    if(listName && listStress)
    {
    }
    else
    {
        alert("Lütfen boş alan bırakmayınız!");
        return
    }

    $.post("/?/todoList/insert/",{
            listName:listName,
            listDate:listDate,
            listContent:listContent,
            listStress:listStress
        },
        function(returnval){
        switch (parseInt(returnval)) {
            case 1:
                alert("İşlem başarıyla gerçekleştirildi!")
                refresh()
                break;
            case 0:
                alert("İşlem sırasında bir hata oldu.")
                break;
            case 2:
                alert("Aynı başlık tekrar kullanılamaz!")
                break;
            default:
                break;
        }
    }).fail(function(){
        alert("İşlem sırasında bir hata oldu.")
    })
}

function todoArrangement(el)
{
    var index = el.dataset.id
    var listName = $("#todoUpdateTitle").val()
    var listDate = $("#todoUpdateDate").val()
    var listContent = tinymce.get("todoUpdateContent").getContent()
    var listStress = $("#todoUpdateStress").val()
    if(listName && listStress)
    {
        $.post("/?/todoList/update/",{
                index:index,
                listName:listName,
                listDate:listDate,
                listContent:listContent,
                listStress:listStress
            },
            function(returnval){
                setTimeout(function(){
                    switch (parseInt(returnval)) {
                        case 1:
                            alert("İşlem başarıyla gerçekleştirildi!")
                            refresh()
                            break;
                        case 0:
                            alert("İşlem sırasında bir hata oldu.")
                            break;
                        case 2:
                            alert("Aynı başlık tekrar kullanılamaz!")
                            break;
                        default:
                            break;
                    }
                },200)
        }).fail(function(){
            alert("İşlem sırasında bir hata oldu.")
        })
    }
    else
    {
        alert("İşlem iptal edildi!")
    }
}

function todoDelete(el)
{
    var index = el.dataset.id
    Swal.fire({
        title: 'İşlemi gerçekleştirmek istediğinizden emin misiniz ?',
        showDenyButton: true,
        confirmButtonText: 'Sil',
        denyButtonText: `İptal Et`,
        cancelButtonText: `Kapat`
      }).then((result) => {

        if (result.isConfirmed) {
        $.post("/?/todoList/delete/",{index:index},function(returnval){
            if(parseInt(returnval) == 1)
            {
                Swal.fire('İşlem başarıyla gerçekleştirildi!', '', 'success')
                refresh()
            }
        }).fail(function(){
            Swal.fire('İşlem sırasında bir hata oluştu.', '', 'info')
        })
        } else if (result.isDenied) {
          Swal.fire('Silme işlemi iptal Edildi', '', 'info')
        }
    })

}

function arrangementModalIndex(el)
{
    var modalBut = document.getElementById("saveArrangementBut")
    var index = el.dataset.id;
    modalBut.dataset.id = index;
    $.post("/?/todoList/getOne/",{index:index},function(returnval){
        if(parseInt(returnval) !== 0)
        {
            var listEl = JSON.parse(returnval)[0];
            $("#todoUpdateTitle").val(listEl.listName)
            $("#todoUpdateDate").val(listEl.listDate)
            $("#todoUpdateStress").val(listEl.listStress)
            listEl.listContent = (listEl.listContent != null)? listEl.listContent:"";
            tinymce.get("todoUpdateContent").setContent(listEl.listContent)
            $("#exampleModal").modal("show");

        }
        else
        {
            alert("İşlem sırasında bir hata oluştu.")
        }
    })
}

refresh()