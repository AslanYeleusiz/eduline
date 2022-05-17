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
                            <div class="information-item-label">ИНН:</div>
                            <div class="information-item-result">984026******</div>
                        </div>
                        <div class="information-item">
                            <div class="information-item-label">Туған күні:</div>
                            <div class="information-item-result">14.05.1994</div>
                        </div>
                        <div class="information-item">
                            <div class="information-item-label">Жынысы:</div>
                            <div class="information-item-result">Ер</div>
                        </div>
                    </div>
                    <div class="profile-edit">Өзгерту</div>
                </div>
            </div>
            <div class="profile-info-group">
                <div class="profile-info profile-info-phone">
                    <div class="profile-info-header">
                        <div class="profile-info-title">@lang('validation.attributes.phone')</div>
                        <div class="profile-info-description">{{ $user->phone }}</div>
                    </div>
                    <div class="profile-info-action" onclick="editPhonePopup(this)">Өзгерту</div>
                </div>
                <div class="profile-info profile-info-email">
                    <div class="profile-info-header">
                        <div class="profile-info-title">@lang('validation.attributes.email')</div>
                        <div class="profile-info-description">{{ $user->email }}</div>
                    </div>
                    <div class="profile-info-actions-group">
                        @if(!$user->is_email_verified)
                            <div class="profile-info-action">Растау</div>
                        @endif
                        <div class="profile-info-action">Өзгерту</div>
                    </div>
                </div>
                <div class="profile-info profile-info-password">
                    <div class="profile-info-header">
                        <div class="profile-info-title">@lang('validation.attributes.password')</div>
                        <div class="profile-info-description">******************</div>
                    </div>
                    <div class="profile-info-action">Өзгерту</div>
                </div>
            </div>
            <div class="profile-footer">
                <div class="profile-footer-item">
                    <div class="profile-item-content">
                        <div class="profile-footer-content-title">Ұлттық біліктілік тест сертификатын алу</div>
                        <div class="profile-footer-content-description"> ЖСН (ИИН) енгізу арқылы жүктеп алуға болады
                        </div>
                    </div>
                    <a onclick="comingSoon()" class="profile-footer-action">Толығырақ</a>
                </div>
                <div class="profile-footer-item">
                    <div class="profile-item-content">
                        <div class="profile-footer-content-title">Менің материалдарым</div>
                        <div class="profile-footer-content-description">Жинаққа жариялаған барлық материалдарыңыз</div>
                    </div>
                    <a href="{{ route('materials.myMaterials') }}" class="profile-footer-action">Толығырақ</a>
                </div>
                <div class="profile-footer-item">
                    <div class="profile-item-content">
                        <div class="profile-footer-content-title">Жазылым</div>
                        <div class="profile-footer-content-description">Сайтқа жазылып, барлық мүмкіндіктерді шексіз
                            қолданыңыз!
                        </div>
                    </div>
                    <a href="{{ route('profile.subscription') }}" class="profile-footer-action">Толығырақ</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@include('components.EditPhoneModal')

@section('scripts')
    <script>
        function comingSoon() {
            $('.modal').modal('hide');

            setTimeout(() => {
                $('#comingSoonPopup').modal('show');
            }, 500)
        }

        function editPhonePopup(event) {
            $('.modal').modal('hide');

            let userPhone = $.trim($(event).closest('.profile-info-phone').find('.profile-info-description').text())
            let phoneInModal = $("#editPhonePopup").find('.modal-body-subtitle').text(userPhone);

            setTimeout(() => {
                $('#editPhonePopup').modal('show');
            }, 500)
        }

        $(function () {
            $('#editPhonePopup').submit(function (e) {
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
                        if (res.data && res.data.success) {
                            window.location.reload();
                        }
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
