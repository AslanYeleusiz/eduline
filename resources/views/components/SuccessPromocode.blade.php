<div class="modal fade" id="successPromocode" tabindex="-1" role="dialog" aria-labelledby="comingSoonPopup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content inner-modal min-height-auto">
            <div class="modal-header modal-header-auth-padding">
                <h2 class="modal-title">Промокодты енгізіңіз</h2>
                <h2 class="modal-body-title">Құттықтаймыз, сіздің промокод қабылданды</h2>
                <button type="button" class="close modal-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5">
                <table style="width: 100%">
                    <tbody>
                        <tr>
                            <td>Жазылым мерзімі:</td>
                            <td id="table_td_day"></td>
                        </tr>
                        <tr>
                            <td>Уақыты:</td>
                            @if($userSubscription)
                            <td id="table_td_time">{{ $userSubscription->from_date }}
                                - {{ $userSubscription->to_date }}</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
                <button class="modal-default-btn mt-3" onclick="closeActiveCodePopup()">Керемет</button>
            </div>
        </div>
    </div>
</div>
