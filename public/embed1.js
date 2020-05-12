var $collectionHolder;

// setup an "add a ligne" link

var $addLigneButton = $('<button  class="add_tag_link btn btn-success btn-icon-split" type="button">\n' +
    '                    <span class="icon text-white-50">\n' +
    '                      <i class="fas fa-plus"></i>\n' +
    '                    </span>\n' +
    '                    <span class="text">Ajouter un Rubrique</span></button>');
var $newLinkLi = $('<ol></ol>').append($addLigneButton);


jQuery(document).ready(function() {
    // Get the ul that holds the collection of lignes
    $collectionHolder = $('ol.tags');

    // add the "add a ligne" anchor and li to the ligne url
    /////////////////  Supprimer cette ligne pour supprimer le bouton ajouter //////////////
    $collectionHolder.append($newLinkLi);
    ////////////////  FIN SUPRESSION /////////////////////////////////

    $collectionHolder.find('li').each(function() {
        addLigneFormDeleteLink($(this));
    });
    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addLigneButton.on('click', function(e) {
        // add a new tag form (see next code block)
        addLigneForm($collectionHolder, $newLinkLi);
    });
});

////////////  Supprimer cette fonction pour élimner l'ajout de ligne   //////////
function addLigneForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li class="form-group "></li>').append(newForm);
    $newLinkLi.before($newFormLi);
    addLigneFormDeleteLink($newFormLi);
}

////////////  FIN SUPRESSION   //////////

function addLigneFormDeleteLink($ligneFormLi) {
    var $removeFormButton = $('<button class="btn btn-danger btn-icon-split " >' +
        '<span class="icon text-white-50"> <i class="fas fa-trash"></i> </span><span class="text">Supprimer Rubrique</span>' +
        '</button><br><br>');
    $ligneFormLi.append($removeFormButton);

    $removeFormButton.on('click', function(e) {
        // remove the li for the ligne form
        $ligneFormLi.remove();
    });
}
