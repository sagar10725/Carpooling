var comment_for_every_trips = " ";
$(function () {
    $.ajax({
            'url': 'fetch-trips.php',
            'type': 'GET',
            'dataType': 'JSON'
        })
        .done(processSuccess)
        .fail(processFailure);


    $("#addPost").click(function () {
        $.ajax({
            'url': 'trip-submit.php',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                'tripText': $("#txtArea").val()
            }
        }).done(function (item) {
            //alert(item.trip_id + item.created_date + item.trip_text + item.user_id);
            var tripContainer = $("<div>").addClass("tripContainer well").attr("id", "tripContainer_" + item.trip_id);
            var favoriteContainer = $("<div>").addClass("favoriteContainer").append($("<img>").addClass("closeIcon").attr("src", "images/close.png")).append($("<img>").addClass("favoriteIcon").attr("src", "images/favoriteGrey.png"));
            var tripTextContainer = $("<div>").addClass("tripTextContainer").attr("id", "trip_" + item.trip_id).append($("<h4>").addClass("tripHeading").html(item.trip_id + ", " + item.trip_text + "<br>" + ' User Id : ' + item.user_id + ' Date : ' + item.created_date));
            var commentContainer = $("<div>").addClass("commentContainer well");
            var hiddenInput = $("<input>").val(item.trip_id).addClass("hiddenInput").attr({
                "type": "hidden"
            });
            var commentLabel = $("<div>").append($("<label>").addClass("commentLabel").attr("id", "commentLabel_" + item.trip_id));
            var areaButtonDiv = $("<div>");
            var commentArea = $("<textarea>").addClass("commentArea").attr({
                'placeholder': 'Write a comment...',
                'rows': '1',
                'cols': '81'
            });
            var commentButton = $("<button>").text("comment").on("click", processComment).addClass("commentButton");
            $("#tab1")
                .prepend(tripContainer
                    .append(favoriteContainer)
                    .append(tripTextContainer)
                    .append(commentContainer
                        .append(commentLabel.append(hiddenInput))
                        .append(areaButtonDiv.append(commentArea).append(commentButton))));
            $("#txtArea").val("");
            $("#hidePost").click();
        });

    });

    ///// TRIP FETCHING FUNCTION HERE ----------------------------- //////
    ///// COMMENT FETCHING FUNCTION HERE ----------------------------- //////

    $("body").delegate('.commentArea', 'keypress', capture_enter);

    function capture_enter(event) {
        if (event.which == 13) {
            var comment_text = $(this).val();
            //alert(comment_text);
            var trip_id = $(this).parent().prev().children('.hiddenInput').val();
            //alert(trip_id);
            var _self = $(this);
            $.post(
                'comment-submit.php', {
                    tripID: trip_id,
                    commentText: comment_text
                },
                function (data, textStatus, xhr) {
                    var commentElement = _self.parent().prev().children('.commentLabel');
                    commentElement.append(comment_text).append($('<br>'));
                    $(".commentArea").val("");
                });
        }

    }

});

function processSuccess(data) {

    $.each(data, function (idx, item) {
        $.ajax({
            'url': 'fetch-comments.php',
            'type': 'GET',
            'data': {
                'tripId': this.trip_id
            },
            'dataType': 'JSON'
        }).done(function (_data) {
            // for loop to get all comments from database
            comment_for_every_trips = " ";
            $.each(_data, function (i, _items) {
                comment_for_every_trips += _items.username + " : " + _items.comment_text + "......................." + _items.created_date + "<br>";
            })

            /*  val favorites = favoriteCheck(item.trip_id);
            var img;
            if(favorites !==null){
                img = $("<img>").addClass("favoriteIcon").attr("src", "../Images/favorite.png");
            }else{
                img = $("<img>").addClass("favoriteIcon").attr("src", "../Images/favoriteGrey.png");
            }
    */
            var tripContainer = $("<div>").addClass("tripContainer well").attr("id", "tripContainer_" + item.trip_id);
            var favoriteContainer = $("<div>").addClass("favoriteContainer").append($("<img>").addClass("closeIcon").on("click", deleteTrips).attr("src", "images/close.png")).append($("<img>").addClass("favoriteIcon").on("click", favorite).attr("src", "images/favoriteGrey.png"));
            var tripTextContainer = $("<div>").attr("id", "trip_" + item.trip_id).append($("<h4>").addClass("tripHeading").html(item.trip_id + ", " + item.trip_text + "<br>" + ' User Id : ' + item.user_id + ' Date : ' + item.created_date));


            var commentContainer = $("<div>").addClass("commentContainer");
            var hiddenInput = $("<input>").val(item.trip_id).addClass("hiddenInput").attr({
                "type": "hidden"
            });
            var commentArea = '<textarea class="form-control" rows="1" id="txtArea" placeholder ="Write a comment..."></textarea>';
            var commentLabel = $("<div>").append($("<label>").addClass("commentLabel").attr("id", "commentLabel_" + item.trip_id).html(comment_for_every_trips));
            var areaButtonDiv = $("<div>");
            //  var commentArea = $("<textarea>").addClass("commentArea").attr({
            // 'placeholder': 'Write a comment...',
            // 'rows': '1',
            // 'cols': '81'
            //});
            var commentButton = $("<button>").addClass("btn btn-primary add-comment").text("Comment").on("click", processComment);
            $("#tab1")
                .append(tripContainer
                    .append(favoriteContainer)
                    .append(tripTextContainer)
                    .append(commentContainer
                        .append(commentLabel.append(hiddenInput))
                        .append(areaButtonDiv.append(commentArea).append(commentButton))));
        }).fail(function () {
            alert("fail");
        });
        comment_for_every_trips = " ";
    });
}

function processFailure(xhr, status, exception) {
    console.log(xhr, status, exception);
}

function processComment() { // Comment Handler
    var trip_id = $(this).parent().prev().children('.hiddenInput').val();
    var comment_text = $(this).prev().val();
    var this_object = $(this);
    //var postComment = this_object.parent().prev().children().val();
    $.ajax({
            'url': 'comment-submit.php',
            'type': 'POST',
            'data': {
                'tripID': trip_id,
                'commentText': comment_text
            }
        })
        .done(function processCommentSuccess() {
            $(".commentArea").val("");
            var commentElement = this_object.parent().prev().children('.commentLabel');
            commentElement.append(comment_text).append($('<br>'));

        }).fail(processCommentFailure);
}

function processCommentFailure(xhr, status, exception) {
    console.log(xhr, status, exception);
}

function favorite() {
    var _self = $(this);
    var id = $(_self.parent().next().next().children()[0]).children('.hiddenInput').val();
    console.log(id);
    if ((_self.attr('src')) === 'images/favorite.png') {
        $.ajax({
            'url': 'favourate-submit.php',
            'type': 'POST',
            'data': {
                'tripID': id,
                'do': 'remove'
            }
        }).done(function () {
            _self.attr('src', 'images/favoriteGrey.png');
        }).fail(processFailure);
    } else {
        $.ajax({
            'url': 'favourate-submit.php',
            'type': 'POST',
            'data': {
                'tripID': id,
                'do': 'add'
            }
        }).done(function () {
            _self.attr('src', 'images/favorite.png');
        }).fail(processFailure);
    }
}

function processFailure(xhr, status, exception) {
    console.log(xhr, status, exception);
}

function deleteTrips(event) {
    if (confirm("Are you sure to delete the trip ? ") == true) {
        // alert('delete data');
        var _self = $(this);
        var trip_id = $(_self.parent().next().next().children()[0]).children('.hiddenInput').val();
        //alert(trip_id);
        $.post('delete-trips.php', {
                trip_id: trip_id
            },
            function (data, textStatus, xhr) {
                if (data == "trip_deleted") {
                    _self.parent().parent().remove();
                    alert(trip_id + " is removed");
                } else if (data == "cannot_deleted") {
                    alert("you cannot delete other trip post");
                } else {
                    alert("fail");
                }
            });
    }
}

/*
function favoriteCheck(id){
    $.get({
        'favorite.list.php',
    },
        function(data, textStatus, xhr){
            if(data.trip_id == id){
                return id;
            }else{
                return null;
            }
        });    
}
*/