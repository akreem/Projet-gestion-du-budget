var $personne_pays =$("#personne_pays")
var $token =$("#personne_token")

$personne_pays.change(function () {
    var $form = $(this).closest('form')
    var data ={}
    data[$token.attr('name')]=$token.val()
    data[$personne_pays.attr('name')]=$personne_pays.val()

    $.post($form.attr("action"), data).then(function (response)
    {
        $("#personne_ville").replaceWith(
            $(response).find("#personne_ville")
        )
        
    })
})