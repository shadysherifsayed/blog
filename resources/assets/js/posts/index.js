const Swal = require('sweetalert');
const Mustache = require('mustache');

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
        title: 'Edit a Category',
        className: "info"
    }).then(input => {
        let name = input.length == 0 ? categoryName : input;
        axios.put(action, {
            name
        })
            .then(response => {
                $(`.posts-category-${response.data.id}`).text(name);
                $(`.sidebar-category-${response.data.id}`).text(name);
            }).catch(error => {
                let data = error.response.data;
                if (data.errors) {
                    Swal({
                        icon: 'error',
                        text: data.errors.name[0]
                    });
                }
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
        })
        .catch(error => {
            let data = error.response.data;
            if (data.errors) {
                Swal({
                    icon: 'error',
                    text: data.errors.name[0],
                    buttons: false
                });
            }
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