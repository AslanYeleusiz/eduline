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
                <div class="profile-info">
                    <div class="profile-info-header">
                        <div class="profile-info-title">@lang('validation.attributes.phone')</div>
                        <div class="profile-info-description">{{ $user->phone }}</div>
                    </div>
                    <div class="profile-info-action">Өзгерту</div>
                </div>
                <div class="profile-info">
                    <div class="profile-info-header">
                        <div class="profile-info-title">@lang('validation.attributes.email')</div>
                        <div class="profile-info-description">{{ $user->email }}</div>
                    </div>
                    <div class="profile-info-actions-group">
                        <div class="profile-info-action">Растау</div>
                        <div class="profile-info-action">Өзгерту</div>
                    </div>
                </div>
                <div class="profile-info">
                    <div class="profile-info-header">
                        <div class="profile-info-title">@lang('validation.attributes.password')</div>
                        <div class="profile-info-description">******************</div>
                    </div>
                    <div class="profile-info-action">Өзгерту</div>
                </div>
            </div>
        </div>
    </section>
@endsection
