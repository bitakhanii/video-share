$(document).ready(function () {
    $('.like-resource').on('click', function (e) {
        e.preventDefault();

        let tag = $(this);
        let resourceId = tag.data('id');
        let resource = tag.data('resource');
        let resourceContainer = tag.closest('.' + resource + '-like-container');
        let dislikeContainer = resourceContainer.find('.dislike-resource');

        $.ajax({
            url: '/' + resource + '/' + resourceId + '/like',
            method: 'GET',
            data: '',
            success: function (response) {
                sweet_alert(response);

                let likeStatus = response.data.status;

                let likesCountEl = tag.find('span');
                let likesCount = parseInt(likesCountEl.text());
                let dislikeElVal = dislikeContainer.find('span');

                if (likeStatus === 'added') {
                    likesCount++;
                    tag.css('color', '#1b87ff');
                } else if (likeStatus === 'removed') {
                    likesCount--;
                    tag.css('color', '#aaaaaa');
                } else if (likeStatus === 'changed') {
                    likesCount++;
                    tag.css('color', '#1b87ff');

                    dislikeElVal.text(parseInt(dislikeElVal.text()) - 1);
                    dislikeContainer.css('color', '#aaaaaa');
                }

                likesCountEl.text(likesCount);
            }
        })
    })
})
