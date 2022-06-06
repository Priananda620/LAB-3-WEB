function clearMsgOutput() {
    console.log("dsadsdda")
    $('#username-already-exist').css('display', 'none')
    $('#unmatch-password').css('display', 'none')
    $('#no-data').css('display', 'none')
    $('#unmatch-pass-length').css('display', 'none')
    $('button#register-action .fa-2x').css('display', 'none')
    
    $('#wrong_password').css('display', 'none')
    $('#email_not_registered').css('display', 'none')

    $('#SUCCESS-login').css('display', 'none')
    $('#SUCCESS-regis').css('display', 'none')
}



$(document).ready(() => {
    var r = document.querySelector(':root');


    const heroTextDouble = document.querySelectorAll(".hero-text-double")


    for (let i = 0; i < heroTextDouble.length; i++) {
        var delayInMilliseconds = 500

        setTimeout(function () {
            heroTextDouble[i].classList.add('logo-loaded')
        }, delayInMilliseconds);
    }



    const buttonDarkToggle = document.querySelector('#dark-switch-input')

    buttonDarkToggle.addEventListener('click', function () {
        const toggler = document.querySelector('input#dark-switch-input')
        const togglerVal = toggler.getAttribute("checked");

        console.log(togglerVal)

        if (togglerVal == "false" || togglerVal == "null") {
            console.log("aaaaaaaa")
            toggler.setAttribute("checked", "true");
            r.style.setProperty('--base-color', '#1d1d1d')
            r.style.setProperty('--display-font-color', '#eef5fa')
            r.style.setProperty('--base-color-lifted-1', '#2b2b2b')
            r.style.setProperty('--section-bg', '#27215a')
            r.style.setProperty('--display-font-color-2nd', '#c1c4c6')
        } else {
            console.log("bbbbb")
            toggler.setAttribute("checked", "false");
            r.style.setProperty('--base-color', '#888cb0')
            r.style.setProperty('--display-font-color', '#131c22')
            r.style.setProperty('--base-color-lifted-1', '#e0e3ff')
            r.style.setProperty('--section-bg', '#6a63ab')
            r.style.setProperty('--display-font-color-2nd', '#424c53')
        }

        // document.querySelector('input #dark-switch-input').checked = !toggler
    })

    $(".login-show").on('click', (e) => {
        e.preventDefault()
        console.log("SHOOOOOWWWW")
        $("body").addClass("overlay-active")
        $("#register-body").addClass("d-none")
        $("#login-body").removeClass("d-none")
        $("#overlay-outter").removeClass("align-items-start")
        $("#overlay-outter").addClass("align-items-center")

        clearMsgOutput()
    })


    $(".register-show").on('click', (e) => {
        e.preventDefault()
        console.log("SHOOOOOWWWW")
        $("body").addClass("overlay-active")
        $("#login-body").addClass("d-none")
        $("#register-body").removeClass("d-none")
        $("#overlay-outter").addClass("align-items-start")
        $("#overlay-outter").removeClass("align-items-center")

        clearMsgOutput()

    })

    $("#xmark-button").on('click', (e) => {
        e.preventDefault()
        console.log("CLOOOOOOSEEEEEEE")
        $("body").removeClass("overlay-active")
    })


    $(".clear-input-action").on('click', function (e) {
        e.preventDefault()
        $("#overlay-wrapper form input").val("")
        $("#overlay-wrapper textarea").val("")
    })

    $(".show-password").on('click', () => {
        if ($("#overlay-wrapper form input[name='password'], #overlay-wrapper form input[name='verify_pass']").attr('type') == "password") {
            $("#overlay-wrapper form input[name='password'], #overlay-wrapper form input[name='verify_pass']").attr('type', 'text');
            $(".show-password").html('hide&nbsp;<i class="fas fa-eye-slash"></i>');
        } else {
            $("#overlay-wrapper form input[name='password'], #overlay-wrapper form input[name='verify_pass']").attr('type', 'password');
            $(".show-password").html('show&nbsp;<i class="fas fa-eye"></i>');
        }
    })

    $("button#register-action").on('click', (e) => {
        console.log("REGISTEEERRRR")
        clearMsgOutput()

        let form = $("#register-body form")[0]
        let fd = new FormData(form)


        if (fd.get('email') != "" && fd.get('username') != "" && fd.get('phone') != "" && fd.get('address') != "" && fd.get('user_image64').length !== 0 && fd.get('password') != "" && fd.get('verify_pass') != "") {

            $('.fa-2x').addClass("d-block")
            e.preventDefault();

            let reader = new FileReader()
            reader.onloadend = () => {
                // console.log(reader.result)
                fd.delete("user_image64")
                fd.append("user_image64", reader.result)
                console.log(fd.get('user_image64'))
                console.log(fd.get("email"))

                $.ajax({
                    url: 'api/register.php',
                    method: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('.fa-2x').removeClass("d-block")
                        let json = response
                        console.log(json)

                        if (json.success) {
                            console.log(json.success);
                            console.log(json.account_data);
                            $('#SUCCESS-regis').css('display', 'unset')
                            // location.reload();
                        } else if (!json.success && json.no_data) {
                            console.log(json.success);
                            console.log("no_data:")
                            console.log(json.no_data)
                            $('#no-data').css('display', 'unset')
                        } else if (!json.success && json.password_verify_unmatch) {
                            console.log(json.success);
                            console.log("password_verify_unmatch:")
                            console.log(json.password_verify_unmatch)
                            $('#unmatch-password').css('display', 'unset')
                        } else if (!json.success && json.account_exist) {
                            console.log(json.success);
                            console.log("account_exist:")
                            console.log(json.account_exist);
                            $('#username-already-exist').css('display', 'unset');
                        } else if (!json.success && json.password_length_unmatch) {
                            console.log(json.success);
                            console.log("password_length_unmatch:")
                            console.log(json.password_length_unmatch);
                            $('#unmatch-pass-length').css('display', 'unset');
                        } else if (!json.success) {
                            console.log("success:")
                            console.log(json.success);
                        }
                    }
                })
            }
            reader.readAsDataURL(fd.get('user_image64'))

        } else {
            $('#no-data').css('display', 'unset')
            return
        }
    })

    $("button#login-action").on('click', (e) => {
        console.log("LOGGIIIIIN")
        clearMsgOutput()

        let form = $("#login-body form")[0]
        let fd = new FormData(form)


        if (fd.get('email') != "" && fd.get('password') != "") {

            $('.fa-2x').addClass("d-block")
            e.preventDefault();

            // if(fd.get('remember') == null){
            //     fd.set('remember') == "off"
            // }

            console.log(fd.get('remember'))

            // console.log(reader.result)
            console.log(fd.get('email'))
            console.log(fd.get("password"))

            $.ajax({
                url: 'api/login.php',
                method: 'POST',
                data: fd,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('.fa-2x').removeClass("d-block")
                    let json = response
                    console.log(json)

                    if (json.success) {
                        console.log(json.success);
                        console.log(json.account_data);
                        $('#SUCCESS-login').css('display', 'unset')
                        // location.reload();
                    } else if (!json.success && json.no_data) {
                        
                        console.log(json.success);
                        console.log("no_data:")
                        console.log(json.no_data)

                        $('#no-data').css('display', 'unset')
                    } else if (!json.success && json.email_not_registered) {
                        console.log(json.success);
                        console.log("email_not_registered:")
                        console.log(json.email_not_registered)
                        
                        $('#email_not_registered').css('display', 'unset')
                    } else if (!json.success && json.wrong_password) {
                        console.log(json.success);
                        console.log("wrong_password:")
                        console.log(json.wrong_password);
                        $('#wrong_password').css('display', 'unset');
                    }
                }
            })
  

        } else {
            $('#no-data').css('display', 'unset')
            return
        }
    })
});

