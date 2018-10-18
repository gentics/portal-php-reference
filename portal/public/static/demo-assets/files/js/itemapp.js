const userCommentField = document.querySelector('#userCommentField');
const commentForm = document.querySelector('.comment-form');
const submitBtn = document.querySelector('.btn.btn-primary.float-right');
const commentField = document.querySelector('.comment-field');
const userComment = document.querySelector('.userComment');
const starreview = document.querySelector('.starReviews');

//BASIC COMMENT

submitBtn.addEventListener('click', function (e) {
    const div = document.createElement('div');
    div.className = 'comment1';
    const img = document.createElement('img');
    img.setAttribute('src', 'https://images.unsplash.com/photo-1480455624313-e29b44bbfde1?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=153fb8f3b75056ae1c47da65bf392afa&auto=format&fit=crop&w=1350&q=80')
    img.setAttribute('title', 'You');
    const comment = document.createElement('div');
    comment.className = 'userComment form-control float-left'
    comment.textContent = userCommentField.value;
    div.appendChild(img);
    div.appendChild(comment);
    commentField.appendChild(div);
    userCommentField.value = "";


    e.preventDefault();

});

function openReview(e) {
    starreview.classList.remove('d-none');
}

function closeReview(e) {
    starreview.classList.add('d-none');
}

