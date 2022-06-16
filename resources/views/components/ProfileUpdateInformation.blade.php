<div class="modal fade" id="profileUpdateInformation" tabindex="-1" role="dialog" aria-labelledby="loginPopup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content inner-modal">
            <div class="modal-header">
                <h2 class="modal-title">Жеке деректерді өңдеу</h2>
                <button type="button" class="close modal-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="profileEditInformation" class="modal-form" action="{{ route('profile.ajax.updateProfile', auth()->user()) }}" method="POST">
                    @csrf

                    <input type="hidden" name="endRoute" class="endRoute" value="">

                    <div class="form-input-block">
                        <label class="modal-form-label" for="iin">@lang('site.ЖСН'):</label>
                        <input id="iin" name="iin" class="modal-form-input" type="text" placeholder="@lang('site.ЖСН')" value="{{ auth()->user()->iin }}">
                        <span class="invalid error-iin" role="alert" id="error-login-iin"></span>
                    </div>

                    <div class="form-input-block">
                        <label class="modal-form-label" for="birthday">@lang('site.Туған күні'):</label>
                        <input id="birthday" name="birthday" pattern="(?:19|20)\[0-9\]{2}-(?:(?:0\[1-9\]|1\[0-2\])-(?:0\[1-9\]|1\[0-9\]|2\[0-9\])|(?:(?!02)(?:0\[1-9\]|1\[0-2\])-(?:30))|(?:(?:0\[13578\]|1\[02\])-31))"
                               title="Enter a date in this format YYYY-MM-DD" placeholder="YYYY-MM-DD" class="modal-form-input" type="date" placeholder="@lang('site.Туған күні')" value="{{ auth()->user()->birthday }}">
                        <span class="invalid error-iin" role="alert" id="error-login-birthday"></span>
                    </div>

                    <div class="form-input-block">
                        <label class="modal-form-label" for="sex">@lang('site.Жынысы'):</label>
                        <select name="sex" id="sex" class="modal-form-input" style="appearance: none; -webkit-appearance: none; -moz-appearance: none;" value="{{ auth()->user()->sex }}">
                            <option value="1">Ер</option>
                            <option value="0">Әйел</option>
                        </select>
{{--                        <input id="sex" name="sex" class="modal-form-input" type="text" placeholder="@lang('site.Жынысы')">--}}
                        <span class="invalid error-iin" role="alert" id="error-login-sex"></span>
                    </div>

                    <button class="modal-default-btn">Сақтау</button>
                </form>
            </div>

        </div>
    </div>
</div>
