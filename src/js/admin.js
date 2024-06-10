document.getElementById("form-title").addEventListener("change", () => changeTitle())
document.getElementById("form-description").addEventListener("change", () => changeDescription())
document.getElementById("form-author-name").addEventListener("change", () => changeAuthorName())
document.getElementById("form-publish-date").addEventListener("change", () => changePublishDate())
document.getElementById("load-author-photo").addEventListener("change", () => previewAuthorPhoto())
document.getElementById("load-main-image").addEventListener("change", () => previewMainImage())
document.getElementById("load-card-image").addEventListener("change", () => previewCardImage())
document.getElementById("button-card-image-trash").addEventListener("click", () => removeCardImage())
document.getElementById("button-main-image-trash").addEventListener("click", () => removeMainImage())
document.getElementById("button-author-photo-trash").addEventListener("click", () => removeAuthorPhoto())
document.querySelector(".publish-block__publish-button").addEventListener("click", () => publishPost()) 
document.querySelector(".account-menu__log-out-button").addEventListener("click", () => logout()) 
let author_photo = ""
let card_image = ""
let article_image = ""
function one() {
    console.log('Title')
}

function logout() {
    fetch('/api/logout.php', {
        method: 'GET',
        //headers: { 'Content-Type': 'application/json' },
        //body: JSON.stringify(json_arr) // Ваши данные для отправки
    })
        .then(res => {
            if (res.status == '200') { 
                window.location.href = '/login.php';
            }
        })//res.json()))
        //.then(data => console.log('Успешно:', data))
    .catch(error => console.log('Ошибка:', error));
}

function previewAuthorPhoto() {
    const preview = document.getElementById("preview-author-photo")
    const author_preview = document.getElementById("card-preview-author-photo")
    const author_photo_text = document.getElementById("author-photo__text")
    const upload_button = document.getElementById("button-author-photo-upload")
    const trash_button = document.getElementById("button-author-photo-trash")
    const file = document.getElementById("load-author-photo").files[0]
    const reader = new FileReader()

    reader.addEventListener(
        "load",
        () => {
            // convert image file to base64 string
            author_photo = reader.result
            preview.src = reader.result
            upload_button.style.display = 'inline-flex'
            trash_button.style.display = 'inline-flex'
            author_photo_text.style.display = 'none'
            author_preview.src = reader.result
            author_preview.style.display = 'block'
        },
        false,
    );

    if (file) {
        reader.readAsDataURL(file)
    }
}

function previewMainImage() {
    const preview = document.getElementById("preview-main-image")
    const card_preview = document.getElementById("article-preview-main-image")
    const main_image_size = document.getElementById("main-image__size-format-data")
    const upload_button = document.getElementById("button-main-image-upload")
    const trash_button = document.getElementById("button-main-image-trash")
    const file = document.getElementById("load-main-image").files[0]
    const reader = new FileReader()
    reader.addEventListener(
        "load",
        () => {
        // convert image file to base64 string
            preview.src = reader.result
            card_preview.src = reader.result
            card_preview.style.display = 'block'
            upload_button.style.display = 'inline-flex'
            trash_button.style.display = 'inline-flex'
            main_image_size.style.display = 'none'
            article_image = reader.result
        },
        false,
    );

    if (file) {
        let a = reader.readAsDataURL(file)
        
    }
}

function previewCardImage() {
    const preview = document.getElementById("preview-card-image")
    const card_preview = document.getElementById("card-preview-card-image")
    const card_image_size = document.getElementById("card-image__size-format-data")
    const upload_button = document.getElementById("button-card-image-upload")
    const trash_button = document.getElementById("button-card-image-trash")
    const file = document.getElementById("load-card-image").files[0]
    const reader = new FileReader()

    reader.addEventListener(
        "load",
        () => {
        // convert image file to base64 string
            preview.src = reader.result
            card_preview.src = reader.result
            card_preview.style.display = 'block'
            upload_button.style.display = 'inline-flex'
            trash_button.style.display = 'inline-flex'
            card_image_size.style.display = 'none'
            card_image = reader.result
        },
        false,
    );

    if (file) {
        reader.readAsDataURL(file)
    }
}

function changeTitle() {
    const form_title = document.getElementById('form-title').value
    const article_preview_title = document.getElementById('article-preview-title')
    const card_preview_title = document.getElementById('card-preview-title')
    if (form_title.trim() != '') {
        article_preview_title.textContent = form_title
        card_preview_title.textContent = form_title
    }
    else {
        article_preview_title.textContent = 'New Post'
        card_preview_title.textContent = 'New Post'
    }
    
}

function changeDescription() {
    const form_description = document.getElementById('form-description').value
    const article_preview_description = document.getElementById('article-preview-description')
    const card_preview_description = document.getElementById('card-preview-description')
    if (form_description.trim() != '') {
        article_preview_description.textContent = form_description
        card_preview_description.textContent = form_description
    }
    else {
        article_preview_description.textContent = 'Please, enter any description'
        card_preview_description.textContent = 'Please, enter any description'
    }
    
}

function changeAuthorName() {
    const form_author_name = document.getElementById('form-author-name').value
    const card_preview_author_name = document.getElementById('card-preview-author-name')
    if (form_author_name.trim() != '') {
        card_preview_author_name.textContent = form_author_name
    }
    else {
        card_preview_author_name.textContent = 'Enter author Name'
    }
}

function changePublishDate() {
    const form_publish_date = document.getElementById('form-publish-date').value
    const card_preview_publish_date = document.getElementById('card-preview-publish-date')
    let date_array = form_publish_date.split('-').reverse()
    console.log(date_array.length)
    if (date_array.length == 3) {
        card_preview_publish_date.textContent = `${date_array[0]}/${date_array[1]}/${date_array[2]}`
    } else {
        card_preview_publish_date.textContent = 'dd/mm/yyyy'
    }
}
function removeAuthorPhoto() {
    const preview = document.getElementById("preview-author-photo")
    const author_preview = document.getElementById("card-preview-author-photo")
    const author_photo_text = document.getElementById("author-photo__text")
    const upload_button = document.getElementById("button-author-photo-upload")
    const trash_button = document.getElementById("button-author-photo-trash")
    const file = document.getElementById("load-author-photo")
    file.value = null
    author_photo = ""
    author_preview.style.display = 'none'
    upload_button.style.display = 'none'
    trash_button.style.display = 'none'
    author_photo_text.style.display = 'block'
    preview.src = '/static/img/Avatar.svg'
    console.log('one')
}

function removeMainImage() {
    const preview = document.getElementById("preview-main-image")
    const main_preview = document.getElementById("article-preview-main-image")
    const main_image_size = document.getElementById("main-image__size-format-data")
    const upload_button = document.getElementById("button-main-image-upload")
    const trash_button = document.getElementById("button-main-image-trash")
    const file = document.getElementById("load-card-image")
    file.value = null
    main_image = ""
    main_preview.style.display = 'none'
    upload_button.style.display = 'none'
    trash_button.style.display = 'none'
    main_image_size.style.display = 'block'
    preview.src = '/static/img/UploadImage.svg'
    console.log('one')
}

function removeCardImage() {
    const preview = document.getElementById("preview-card-image")
    const card_preview = document.getElementById("card-preview-card-image")
    const card_image_size = document.getElementById("card-image__size-format-data")
    const upload_button = document.getElementById("button-card-image-upload")
    const trash_button = document.getElementById("button-card-image-trash")
    const file = document.getElementById("load-main-image")
    file.value = null
    card_image = ""
    card_preview.style.display = 'none'
    upload_button.style.display = 'none'
    trash_button.style.display = 'none'
    card_image_size.style.display = 'block'
    preview.src = '/static/img/UploadCardImage.svg'
    console.log('one')
}

function publishPost() {
    // const author_photo = document.getElementById("load-author-photo").files[0]
    // const card_image = document.getElementById("load-card-image").files[0]
    // const article_image = document.getElementById("load-main-image").files[0]
    const publish_date = document.getElementById('form-publish-date')
    const description = document.getElementById('form-description')
    const title = document.getElementById('form-title')
    const author_name = document.getElementById('form-author-name')
    const text_content = document.getElementById('form-text-content')
    const success = document.querySelector('.success')
    const critical = document.querySelector('.critical')

    const title_critical = document.getElementById('input-title-critical')
    const description_critical = document.getElementById('input-description-critical')
    const author_name_critical = document.getElementById('input-author-name-critical')
    const publish_date_critical = document.getElementById('input-publish-date-critical')
    const text_content_critical = document.getElementById('input-text-content-critical')
    let isValid = true

    title_critical.style.display = 'none'
    author_name_critical.style.display = 'none'
    description_critical.style.display = 'none'
    publish_date_critical.style.display = 'none'
    text_content_critical.style.display = 'none'
    critical.style.display = 'flex'
    success.style.display = 'none'

    title.classList.remove('main-info__input-text-invalid')
    description.classList.remove('main-info__input-text-invalid')
    author_name.classList.remove('main-info__input-text-invalid')
    publish_date.classList.remove('main-info__input-text-invalid')
    text_content.classList.remove('publish-content__textarea-invalid')

    if (title.value.trim() === '') {
        console.log('no title')
        title_critical.style.display = 'block'
        title.classList.add('main-info__input-text-invalid')
        isValid = false
    }
    if (description.value.trim() === '') {
        console.log('no description')
        description_critical.style.display = 'block'
        description.classList.add('main-info__input-text-invalid')
        isValid = false
    }
    if (author_name.value.trim() === '') {
        console.log('no author')
        author_name_critical.style.display = 'block'
        author_name.classList.add('main-info__input-text-invalid')
        isValid = false
    }
    let date_array = publish_date.value.split('-').reverse()
    if (date_array.length !== 3) {
        console.log('no date')
        publish_date_critical.style.display = 'block'
        publish_date.classList.add('main-info__input-text-invalid')
        isValid = false
    }
    if (author_photo === "") {
        console.log('no photo')
        isValid = false
    }
    if (card_image === "") {
        console.log('no card')
        isValid = false
    }
    if (article_image === "") {
        console.log('no article')
        isValid = false
    }
    if (text_content.value.trim() === "") {
        console.log('no content')
        text_content_critical.style.display = 'block'
        text_content.classList.add('publish-content__textarea-invalid')
        isValid = false
    }
    if (isValid) {
        critical.style.display = 'none'
        success.style.display = 'flex'
        json_arr = {
            "title": title.value,
            "description": description.value,
            "author_name": author_name.value,
            "publish_date": publish_date.value,
            "author_photo": author_photo,
            "card_image": card_image,
            "article_image": article_image,
            "content": text_content.value,
            "featured": 0,
        }
        console.log('yes', json_arr)
        fetch('/api2.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(json_arr) // Ваши данные для отправки
          })
        .then(res => res.json())
        .then(data => console.log('Успешно:', data))
        .catch(error => console.log('Ошибка:', error));
    }
}

