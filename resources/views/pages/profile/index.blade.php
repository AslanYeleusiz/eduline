@extends('layouts.main')
@section('title', $pageName)
@section('content')

    @component('components.NavBar')
        @slot('profile') @endslot
    @endcomponent

    <section class="materials">
        <div class="cst_pd">
            <div class="profile-header">
                <div class="profile-header-image" style=""></div>
                <div class="profile-header-info">
                    <div class="profile-username">{{ $user->full_name }}</div>
                    <div class="profile-information">
                        <div class="information-item">
                            <div class="information-item-label">@lang('site.ЖСН'):</div>
                            <div class="information-item-result">{{ auth()->user()->iin !== null ? auth()->user()->iin : "Еңгізілмеді" }}</div>
                        </div>
                        <div class="information-item">
                            <div class="information-item-label">@lang('site.Туған күні'):</div>
                            <div class="information-item-result">{{ auth()->user()->birthday !== null ? auth()->user()->birthday : "Еңгізілмеді" }}</div>
                        </div>
                        <div class="information-item">
                            <div class="information-item-label">@lang('site.Жынысы'):</div>
                            <div class="information-item-result">{{ auth()->user()->sex !== null ? auth()->user()->sex : "Еңгізілмеді" }}</div>
                        </div>
                    </div>
                    <div class="profile-edit" onclick="editProfileInformation()">@lang('site.Өзгерту')</div>
                </div>
            </div>
            <div class="profile-info-group">
                <div class="profile-info profile-info-phone">
                    <div class="profile-info-header">
                        <div class="profile-info-title">@lang('validation.attributes.phone')</div>
                        <div class="profile-info-description">{{ $user->phone }}</div>
                    </div>
                    <div class="profile-info-action" onclick="editPhonePopup(this)">@lang('site.Өзгерту')</div>
                </div>
                <div class="profile-info profile-info-email">
                    <div class="profile-info-header">
                        <div class="profile-info-title">Email</div>
                        <div class="profile-info-description">{{ $user->email }}</div>
                    </div>
                    <div class="profile-info-actions-group">
                        @if($user->is_email_verified)
                            <div class="profile-info-action">Расталған</div>
                        @else
                            <form action="{{ route('profile.link.confirm.email') }}" method="GET" id="confirmEmail">
                                <button class="profile-info-action" style="background: none; border: none">@lang('site.Растау')</button>
                            </form>
                        @endif
                        <div class="profile-info-action" onclick="editEmailPopup(this)">@lang('site.Өзгерту')</div>
                    </div>
                </div>
                <div class="profile-info profile-info-password">
                    <div class="profile-info-header">
                        <div class="profile-info-title">@lang('validation.attributes.password')</div>
                        <div class="profile-info-description">******************</div>
                    </div>
                    <div class="profile-info-action" onclick="editPasswordPopup()">@lang('site.Өзгерту')</div>
                </div>
            </div>
            <div class="profile-footer">
                <div class="profile-footer-item">
                    <div class="profile-item-content">
                        <div class="profile-footer-content-title">@lang('site.Ұлттық біліктілік тест сертификатын алу')</div>
                        <div class="profile-footer-content-description"> @lang('site.ЖСН (ИИН) енгізу арқылы жүктеп алуға болады')
                        </div>
                    </div>
                    <a onclick="comingSoon()" class="profile-footer-action">@lang('site.Толығырақ')</a>
                </div>
                <div class="profile-footer-item">
                    <div class="profile-item-content">
                        <div class="profile-footer-content-title">@lang('site.Менің материалдарым')</div>
                        <div class="profile-footer-content-description">@lang('site.Жинаққа жариялаған барлық материалдарыңыз')</div>
                    </div>
                    <a href="{{ route('materials.myMaterials') }}" class="profile-footer-action">@lang('site.Толығырақ')</a>
                </div>
                <div class="profile-footer-item">
                    <div class="profile-item-content">
                        <div class="profile-footer-content-title">@lang('site.Жазылым')</div>
                        <div class="profile-footer-content-description">@lang('site.Сайтқа жазылып, барлық мүмкіндіктерді шексіз қолданыңыз')
                        </div>
                    </div>
                    <a href="{{ route('profile.subscription') }}" class="profile-footer-action">@lang('site.Толығырақ')</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@include('components.EditPhoneModal', ['phone' => $user->phone])
@include('components.ComingSoonModal')
@include('components.EditEmailModal', ['email' => "admin@admin.com"])
@include('components.EditPasswordModal')
@include('components.SmsModal')
@include('components.ProfileUpdateInformation')
@include('components.SuccessPopup')


@section('scripts')
    <script>

        $(".smsCode").keyup(function () {
            console.log('ergerg')
            if (this.value.length == this.maxLength) {
                $(this).next('input').focus();
            }
        });

        function comingSoon() {
            $('.modal').modal('hide');

            setTimeout(() => {
                $('#comingSoonPopup').modal('show');
            }, 500)
        }

        function editProfileInformation() {
            $('.modal').modal('hide');

            setTimeout(() => {
                $('#profileUpdateInformation').modal('show');
            }, 500)
        }

        function editPhonePopup(event) {
            $('.modal').modal('hide');

            setTimeout(() => {
                $('#editPhonePopup').modal('show');
            }, 500)
        }

        function editEmailPopup(event) {
            $('.modal').modal('hide');

            let userEmail = $.trim($(event).closest('.profile-info-phone').find('.profile-info-description').text())
            let emailInModal = $("#editEmailPopup").find('.modal-body-subtitle').text(userEmail);

            setTimeout(() => {
                $('#editEmailPopup').modal('show');
            }, 500)
        }

        function editPasswordPopup(event) {
            $('.modal').modal('hide');

            let userEmail = $.trim($(event).closest('.profile-info-phone').find('.profile-info-description').text())
            let emailInModal = $("#editEmailPopup").find('.modal-body-subtitle').text(userEmail);

            setTimeout(() => {
                $('#editPasswordPopup').modal('show');
            }, 500)
        }

        $(function () {
            $('#editPhoneForm').submit(function (e) {
                e.preventDefault();

                let phone = $('#new-phone').val();

                let _token = $('meta[name="csrf-token"]').attr('content');

                $(".loader").addClass("loading");

                clearInvalidFeedback()

                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: {
                        'phone': phone,
                        '_token': _token
                    },
                    success: function (res) {
                        $(".loader").removeClass("loading");
                        // if (res.data && res.data.success) {
                        //     window.location.reload();
                        // }

                        $("#smsModal .modal-phone").text(phone);

                        $('.modal').modal('hide');

                        setTimeout(() => {
                            $('#smsModal').modal('show');
                        }, 500)
                    },
                    error: function (err) {
                        $(".loader").removeClass("loading");
                        let response_text = JSON.parse(err.responseText);
                        if (response_text.errors && typeof response_text.errors == 'object') {
                            Object.entries(response_text.errors).forEach(([key, value]) => {
                                $('#error-new-' + key).text(value[0]);
                                $('#error-new-' + key).css('display', 'block');
                            })
                        }
                    }
                });
            });

            $('#confirmEmail').submit(function (e) {
                e.preventDefault();
                $('.modal').modal('hide');

                setTimeout(() => {
                    $('#successPopup').modal('show');
                    $('#successPopup .modal-title').text('Cіздің почтаңызға растау сілтемесі жіберілді. Сілтемені басқан соң почтаңыз расталады');
                }, 500)

                const email = $('.profile-info-email .profile-info-header .profile-info-description').text();
                console.log(email)
                let _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: $(this).attr('action'),
                    type: "GET",
                    data: {
                        'email': email,
                        '_token': _token
                    },
                    success: function (res) {
                        console.log(res)
                    },
                    error: function (err) {
                        console.log(err)
                    }
                });
            })

            $('#editPasswordForm').submit(function (e) {
                e.preventDefault();

                let current_password = $('#current_password').val();
                let password = $('#password').val();
                let password_confirmation = $('#password_confirmation').val();


                console.log(current_password + '<br/> ' + password + '<br/> ' + password_confirmation)

                let _token = $('meta[name="csrf-token"]').attr('content');

                $(".loader").addClass("loading");

                clearInvalidFeedback()

                $.ajax({
                    url: $(this).attr('action'),
                    type: "GET",
                    data: {
                        '_token': _token,
                        'current_password': current_password,
                        'password': password,
                        'password_confirmation': password_confirmation,
                    },
                    success: function (res) {
                        $(".loader").removeClass("loading");

                        $('.modal').modal('hide');

                        setTimeout(() => {
                            $('#successPopup').modal('show');
                            $('#successPopup .modal-title').text('Құпия сөз сәтті өзгертілді');
                        }, 500)

                        // if (res.data && res.data.success) {
                        //     window.location.reload();
                        // }
                    },
                    error: function (err) {
                        $(".loader").removeClass("loading");
                        let response_text = JSON.parse(err.responseText);
                        if (response_text.errors && typeof response_text.errors == 'object') {
                            Object.entries(response_text.errors).forEach(([key, value]) => {
                                $('#error-new-' + key).text(value[0]);
                                $('#error-new-' + key).css('display', 'block');
                            })
                        }
                    }
                });
            });

            $('#editEmailForm').submit(function (e) {
                e.preventDefault();

                let email = $('#email').val();

                let _token = $('meta[name="csrf-token"]').attr('content');

                $(".loader").addClass("loading");

                clearInvalidFeedback()

                $.ajax({
                    url: $(this).attr('action'),
                    type: "GET",
                    data: {
                        '_token': _token,
                        'email': email,
                    },
                    success: function (res) {
                        $(".loader").removeClass("loading");

                        $('.modal').modal('hide');

                        console.log('ok')
                        setTimeout(() => {
                            $('#successPopup').modal('show');
                            $('#successPopup .modal-title').text('Cіздің почтаңызға растау сілтемесі жіберілді. Сілтемені басқан соң почтаңыз өзгереді');
                        }, 500)

                        // if (res.data && res.data.success) {
                        //     window.location.reload();
                        // }
                    },
                    error: function (err) {
                        $(".loader").removeClass("loading");
                        let response_text = JSON.parse(err.responseText);
                        if (response_text.errors && typeof response_text.errors == 'object') {
                            Object.entries(response_text.errors).forEach(([key, value]) => {
                                $('#error-new-' + key).text(value[0]);
                                $('#error-new-' + key).css('display', 'block');
                            })
                        }
                    }
                });
            });

            $('#profileEditInformation').submit(function (e) {
                e.preventDefault();

                let iin = $('#iin').val();
                let birthday = $('#birthday').val();
                let sex = $('#sex').val();

                let _token = $('meta[name="csrf-token"]').attr('content');

                $(".loader").addClass("loading");

                console.log(email)

                clearInvalidFeedback()

                $.ajax({
                    url: $(this).attr('action'),
                    type: "GET",
                    data: {
                        '_token': _token,
                        'iin': iin,
                        'birthday': birthday,
                        'sex': sex,
                    },
                    success: function (res) {
                        $(".loader").removeClass("loading");

                        $('.modal').modal('hide');

                        console.log('ok')
                        setTimeout(() => {
                            $('#successPopup').modal('show');
                            $('#successPopup .modal-title').text('Жеке деректеріңіз сәтті өзгертілді');
                        }, 500)

                        // if (res.data && res.data.success) {
                        //     window.location.reload();
                        // }
                    },
                    error: function (err) {
                        $(".loader").removeClass("loading");
                        let response_text = JSON.parse(err.responseText);
                        if (response_text.errors && typeof response_text.errors == 'object') {
                            Object.entries(response_text.errors).forEach(([key, value]) => {
                                $('#error-new-' + key).text(value[0]);
                                $('#error-new-' + key).css('display', 'block');
                            })
                        }
                    }
                });
            });

            $('#smsForm').submit(function (e) {
                e.preventDefault();

                let code1 = $('.smsCode1').val();
                let code2 = $('.smsCode2').val();
                let code3 = $('.smsCode3').val();
                let code4 = $('.smsCode4').val();

                let code = code1 + code2 + code3 + code4

                let phone = $('.modal-phone').text();

                let _token = $('meta[name="csrf-token"]').attr('content');

                $(".loader").addClass("loading");

                console.log(email)

                clearInvalidFeedback()

                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: {
                        '_token': _token,
                        'code': code,
                        'phone': phone,
                    },
                    success: function (res) {
                        $(".loader").removeClass("loading");
                        $('.modal').modal('hide');

                        setTimeout(() => {
                            $('#successPopup').modal('show');
                            $('#successPopup .modal-title').text('Номеріңіз сәтті өзгертілді');
                        }, 500)

                        // if (res.data && res.data.success) {
                        //     window.location.reload();
                        // }
                    },
                    error: function (err) {
                        $(".loader").removeClass("loading");
                        let response_text = JSON.parse(err.responseText);
                        if (response_text.errors && typeof response_text.errors == 'object') {
                            Object.entries(response_text.errors).forEach(([key, value]) => {
                                $('#error-new-' + key).text(value[0]);
                                $('#error-new-' + key).css('display', 'block');
                            })
                        }
                    }
                });
            });
        })

    </script>
@endsection
