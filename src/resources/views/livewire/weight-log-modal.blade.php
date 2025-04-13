<div>
    <button class="btn-submit" wire:click="openModal">データを追加</button>

    @if($isOpen)
    <div class="modal">
        <div class="modal__inner">
            <div class="modal__content">
                <h2 class="modal-title">Weight Logを追加</h2>

                <form wire:submit.prevent="save">
                    <div class="modal-form__group">
                        <label class="modal-form__label">日付 <span class="required">必須</span></label>
                        <input type="date" wire:model="date">
                        @error('date') <p class="error-message">{{ $message }}</p> @enderror
                    </div>

                    <div class="modal-form__group">
                        <label class="modal-form__label">体重 <span class="required">必須</span></label>
                        <div class="input-with-unit">
                            <input type="text" wire:model="weight">
                            <span class="unit-label">kg</span>
                        </div>
                        @error('weight') <p class="error-message">{{ $message }}</p> @enderror
                    </div>

                    <div class="modal-form__group">
                        <label class="modal-form__label">摂取カロリー <span class="required">必須</span></label>
                        <div class="input-with-unit">
                            <input type="text" wire:model="calories">
                            <span class="unit-label">cal</span>
                        </div>
                        @error('calories') <p class="error-message">{{ $message }}</p> @enderror
                    </div>

                    <div class="modal-form__group">
                        <label class="modal-form__label">運動時間 <span class="required">必須</span></label>
                        <input type="time" wire:model="exercise_time">
                        @error('exercise_time') <p class="error-message">{{ $message }}</p> @enderror
                    </div>

                    <div class="modal-form__group">
                        <label class="modal-form__label">運動内容</label>
                        <textarea wire:model="exercise_content"></textarea>
                        @error('exercise_content') <p class="error-message">{{ $message }}</p> @enderror
                    </div>

                    <div class="modal-form__button-group">
                        <button type="button" class="modal-btn-cancel" wire:click="closeModal">戻る</button>
                        <button type="submit" class="modal-form__submit-btn">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>