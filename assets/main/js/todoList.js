tinymce.init({
    selector: '#todoInsertContent'
});

tinymce.init({
    selector: '#todoUpdateContent'
});


function listIt(listlocation="/?/todoList/refresh/",data={})
{
    $.post(listlocation,data,function(returnval){
        if(parseInt(returnval) == "0")
        {
            listIt()
        }
        else
        {
            todoList = JSON.parse(returnval)
            var html = '';
            for(var i=0;i<todoList.length;i++)
            {
                /* The buttons that we use to control our todos */
                var indexStepUp =""; // It changes index to down side of screen 
                var indexStepDown =""; // It changes index to upper side of screen 

                switch (i) {
                    case 0:
                        var indexStepUp = '<button  type="button" style="margin:2px;" class="reLocateBut" data-id1="'+todoList[i].id+'" data-id2="'+todoList[i+1].id+'" onclick="reLocate(this);"><i class="fas fa-sort-numeric-down-alt"></i></button>';
                        break;
                    case todoList.length-1:
                        var indexStepDown = '<button  type="button" style="margin:2px;" class="reLocateBut" data-id1="'+todoList[i].id+'" data-id2="'+todoList[i-1].id+'" onclick="reLocate(this);"><i class="fas fa-sort-numeric-up"></i></button>';
                        break;
                    default:
                        var indexStepUp = '<button  type="button" style="margin:2px;" class="reLocateBut" data-id1="'+todoList[i].id+'" data-id2="'+todoList[i+1].id+'" onclick="reLocate(this);"><i class="fas fa-sort-numeric-down-alt"></i></button>';
                        var indexStepDown = '<button  type="button" style="margin:2px;" class="reLocateBut" data-id1="'+todoList[i].id+'" data-id2="'+todoList[i-1].id+'" onclick="reLocate(this);"><i class="fas fa-sort-numeric-up"></i></button>';
                        break;
                }
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
                
                var listKeywordsHtml ="";
                if( todoList[i].listKeywords !== null && todoList[i].listKeywords.length > 0)
                {
                    var listKeywordsArr = JSON.parse(todoList[i].listKeywords)
                    for(var a=0;a<listKeywordsArr.length;a++){
                        listKeywordsHtml += '<span class="keywords">'+listKeywordsArr[a]+'</span>';
                    }
                }



                html += '<tr '+bgColorControl+'><td>'+indexStepDown+indexStepUp+'</td><td>'+arrangementBut+deleteBut+'</td><td>'+listName+'</td><td>'+listDateHtml+'</td><td><div '+listStressHtml+'></div></td><td>'+listKeywordsHtml+'</td></tr>';
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
    var listKeywords = $("#todoInsertKeywords").val()

    
    $("#todoInsertTitle").val("")
    $("#todoInsertDate").val("")
    tinymce.get("todoInsertContent").setContent("")
    $("#todoInsertStress").val("")
    $("#todoInsertKeywords").val("")

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
            listStress:listStress,
            listKeywords:listKeywords
        },
        function(returnval){
        switch (parseInt(returnval)) {
            case 1:
                alert("İşlem başarıyla gerçekleştirildi!")
                listIt()
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
    var listKeywords = $("#todoUpdateKeywords").val()
    
    if(listName && listStress)
    {
        $.post("/?/todoList/update/",{
                index:index,
                listName:listName,
                listDate:listDate,
                listContent:listContent,
                listStress:listStress,
                listKeywords:listKeywords
            },
            function(returnval){
                setTimeout(function(){
                    switch (parseInt(returnval)) {
                        case 1:
                            alert("İşlem başarıyla gerçekleştirildi!")
                            listIt()
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
                listIt()
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

            /* Keywords array indexes will merge into a string here*/
            if( listEl.listKeywords !== null && listEl.listKeywords.length > 0)
            {
                var listKeywordsArr = JSON.parse(listEl.listKeywords)
                var listKeywordsHtml = listKeywordsArr[0];
                for(var i=1;i<listKeywordsArr.length;i++){
                    listKeywordsHtml += ", "+listKeywordsArr[i];
                }
                $("#todoUpdateKeywords").val(listKeywordsHtml)
            }
            else
            {
                $("#todoUpdateKeywords").val(listEl.listKeywords)
            }
            

            
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

function reLocate(el)
{
    var index1 = el.dataset.id1;
    var index2 = el.dataset.id2;

    $.post("/?/todoList/reLocate/",{index1:index1,index2:index2},function(returnval){
        switch (returnval) {
            case "1":
                listIt()
                break;
            case "0":
                alert("İşlem sırasında bir hata oluştu.")
                break;
            default:
                break;
        }
    }).fail(function(){
        alert("İşlem sırasında bir hata oluştu.")
    })
}

document.getElementById("listSearch").addEventListener("change",function(){
    var searchval = document.getElementById("listSearch").value;
    listIt("/?/todoList/search/",{search:searchval})

},false)

listIt()