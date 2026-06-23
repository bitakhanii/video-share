$(document).ready(function () {
    $('.dislike-resource').on('click', function (e) {
        e.preventDefault();

        let tag = $(this);
        let resourceId = tag.data('id');
        let resource = tag.data('resource');
        let resourceContainer = tag.closest('.' + resource + '-like-container');
        let likeContainer = resourceContainer.find('.like-resource');

        $.ajax({
            url: '/' + resource + '/' + resourceId + '/dislike',
            method: 'GET',
            data: '',
            success: function (response) {
                sweet_alert(response);

                let likeStatus = response.data.status;

                let likesCountElement = tag.find('span');
                let likesCount = parseInt(likesCountElement.text());
                let likeElVal = likeContainer.find('span');

                if (likeStatus === 'added') {
                    likesCount++;
                    tag.css('color', '#e0001c');
                } else if (likeStatus === 'removed') {
                    likesCount--;
                    tag.css('color', '#aaaaaa');
                } else if (likeStatus === 'changed') {
                    likesCount++;
                    tag.css('color', '#e0001c');

                    likeElVal.text(parseInt(likeElVal.text()) - 1);
                    likeContainer.css('color', '#aaaaaa');
                }

                likesCountElement.text(likesCount);
            }
        })
    })
})
