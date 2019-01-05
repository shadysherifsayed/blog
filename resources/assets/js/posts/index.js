const Swal = require('sweetalert');
const Mustache = require('mustache');

const convertImgToSvg = $img => {
    // Get all the attributes.
    var attributes = $img.prop("attributes");
    // Get the image's URL.
    var imgURL = $img.attr("src");
    // Fire an AJAX GET request to the URL.
    $.get(imgURL, function (data) {
        // The data you get includes the document type definition, which we don't need.
        // We are only interested in the <svg> tag inside that.
        var $svg = $(data).find('svg');
        // Remove any invalid XML tags as per http://validator.w3.org
        $svg = $svg.removeAttr('xmlns:a');
        // Loop through original image's attributes and apply on SVG
        $.each(attributes, function () {
            $svg.attr(this.name, this.value);
        });
        // Replace image with new SVG
        $img.replaceWith($svg);
    });

}

// Delete category
$(document).on('click', '.delete.category', function () {
    let $this = $(this);
    let action = $this.attr('action');
    Swal({
        title: 'Are you sure?',
        text: "Once deleted, you will not be able to recover it!",
        icon: "error",
        buttons: true,
        dangerMode: true,
        focusCancel: true
    }).then(result => {
        if (result) {
            axios.delete(action)
                .then((response) => {
                    $(`.posts-category-${response.data.id}`).remove();
                    $(`.sidebar-category-${response.data.id}`).parent().remove();
                });
        }
    });
});

// Edit category
$(document).on('click', '.edit.category', function () {
    let $this = $(this);
    let action = $this.attr('action');
    let categoryName = $this.closest('li').find('a').text().trim();
    Swal({
        content: {
            element: "input",
            attributes: {
                placeholder: "Category Name",
                type: "text",
                value: categoryName,
                name: 'name'
            }
        },
    }).then(input => {
        let name = input.length == 0 ? categoryName : input;
        axios.put(action, {
            name
        })
            .then(response => {
                $(`.posts-category-${response.data.id}`).text(name);
                $(`.sidebar-category-${response.data.id}`).text(name);
            });

    });

});

// Add category
$(document).on('submit', '#add-category', function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    let $this = $(this);
    let action = $this.attr('action');
    axios.post(action, formData)
        .then(response => {
            let category = response.data.category;
            var template = $('#category-template').html();
            Mustache.parse(template); // optional, speeds up future uses
            var rendered = Mustache.render(template, {
                name: category.name,
                showRoute: category.show,
                actionsRoute: category.actions,
                class: `sidebar-category-${category.id}`
            });
            $('.sidebar .categories').append(rendered);
            $this.find('input').val(null);
            $(`aside .categories`).find('img').each(function () {
                convertImgToSvg($(this));
            });
        });
    
});

// Delete post
$(document).on('click', '.delete.post', function () {
    let $this = $(this);
    let action = $this.attr('action');
    Swal({
        title: 'Are you sure?',
        text: "Once deleted, you will not be able to recover it!",
        icon: "error",
        buttons: true,
        dangerMode: true,
        focusCancel: true
    }).then(result => {
        if (result) {
            axios.delete(action)
                .then((response) => {
                    $(`.posts-${response.data.target}`).remove();
                    $(`.sidebar-${response.data.target}`).parent().remove();
                });
        }
    });
});