const docTitle = document.title;

window.addEventListener("blur", () => {
  document.title = "Submit Review :)";
});

window.addEventListener("focus", () => {
  document.title = docTitle;
});

$(function () {
  // rating plugin
  var $rateYo = $("#rateYo").rateYo({
    numStars: 5,
    spacing: "6px",
    multiColor: {
      startColor: "#FF0000", //RED
      endColor: "#81C905", //GREEN
    },
  });

  $("#getRating").click(function () {
    // add rating value
    var rating = $rateYo.rateYo("rating");
    $("#rateValue").val(rating);

    var rateval = $("#rateValue").val();
    var review_email = $("#user_email").val();

    // AJAX POST request
    $.ajax({
      type: "POST",
      url: "rating.php",
      data: {
        ratevalue: rateval,
        review_email: review_email,
        rating: "done",
      },
      success: function (data) {
        var data = JSON.parse(data);

        var error = data.error;
        var msg = data.error_message;

        if (error === 5) {
          $(".alert").removeClass("d-none");
          $(".alert").addClass("d-block");
          $("#error_msg").html(msg);
        } else if (error === 1) {
          $(".alert").removeClass("d-none");
          $(".alert").addClass("d-block");
          $("#error_msg").html(msg);
        } else if (error === 2) {
          $(".alert").removeClass("d-none");
          $(".alert").addClass("d-block");
          $("#error_msg").html(msg);
        } else if (error === 3) {
          $(".alert").removeClass("d-none");
          $(".alert").addClass("d-block");
          $("#error_msg").html(msg);
        } else if (error === 4) {
          $(".alert").addClass("d-none");
          $(".alert").removeClass("d-block");
          $(".flip").css("transform", "rotateY(180deg)");
          $("#success_msg").html(msg);
          setInterval(function () {
            $(".flip").css("transform", "rotateY(0deg)");
            setInterval(function () {
              location.reload();
            }, 340);
          }, 3000);
        } else {
          $(".alert").addClass("d-none");
          $(".alert").removeClass("d-block");
          $(".flip").css("transform", "rotateY(0deg)");
        }
      },
    });
  });
});
