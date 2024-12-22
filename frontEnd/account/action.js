$(document).ready(function () {
    $("form").on("submit", function (ev) {
        ev.preventDefault();
        var formData = $(this).serialize();
        $("#overlay").css("display", "flex");
        $.ajax({
            url: "http://localhost/ManageSystem/backEnd/src/api/users/insert.php",
            method: "POST",
            data: formData,
            dataType: "json",
            success: (result) => {
                $("#overlay").css("display", "none");
                if (result.code == 200)
                {
                    msuccess(result.message);
                }
                else
                    merror(result.message);
                close();
            },
            error: (err) => {
                $("#overlay").css("display", "none");
            }
        });
    });
// ============functions=======================
    function msuccess(message) {
        $("body").append(` 
                    <div class="card">
        <div class="container-close">
            <div class="btn-close">
                <span>
                    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="Menu / Close_SM">
                            <path id="Vector" d="M16 16L12 12M12 12L8 8M12 12L16 8M12 12L8 16" stroke="#000000"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                    </svg>
                </span>
            </div>
        </div>
        <h1>تم بنجاح</h1>
        <div class="check">
            <i class="checkmark">✓</i>
        </div>
        <p>${message}</p>
    </div>`);
        setTimeout(function () {
            $(".card").css("right", "15%");
        }, 5);
    }
    function merror(message) {
        $("body").append(` 
                    <div class="card">
        <div class="container-close">
            <div class="btn-close">
                <span>
                    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="Menu / Close_SM">
                            <path id="Vector" d="M16 16L12 12M12 12L8 8M12 12L16 8M12 12L8 16" stroke="#000000"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                    </svg>
                </span>
            </div>
        </div>
        <h1>خطاء</h1>
        <div class="check">
            <i class="checkmark">✓</i>
        </div>
        <p>${message}</p>
    </div>`);
        $(".checkmark").text("x");
        $(".checkmark").css("color", "red");
        $(".card>h1").css("color", "red");
        setTimeout(function () {
            $(".card").css("right", "15%");
        }, 5);
    }
    function close() {
        $(".btn-close").on("click", function () {
            $(this).parent().parent().fadeOut(500, function () {
                $(this).remove();
            });
        });
    }
});