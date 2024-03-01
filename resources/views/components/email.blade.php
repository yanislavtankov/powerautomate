<div class="grid grid-cols-1 md:grid-cols-2">
    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
        <p>
            <b>Дата и час:</b> {{ $email->created_at }}
        </p>
        <p>
            <b>Клиент:</b> {{ $email->from }}
        </p>
        <p>
            <b>Билет:</b> {{ substr($email->subject, 1, 17) }}
        </p>
        <p>
            <b>Относно:</b> {{ substr($email->subject, strpos($email->subject, "[TICKET:") + 19) }}
        </p>
        <p class="mt-3">
            <b>Съдържание:</b></br> {{ $email->message }}
        </p>
    </div>
    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
        <form method="POST" action="{{ route('update', ['id' => $email->id]) }}">
            @csrf
            <div>
                <x-label for="status" :value="__('Статус')" />
                <select name="status" class="w-full">
                    <option value="0" @if($email->status == 0)
                        selected
                        @endif
                        >Получен</option>
                    <option value="1" @if($email->status == 1)
                        selected
                        @endif
                        >Назначен е оператор</option>
                    <option value="2" @if($email->status == 2)
                        selected
                        @endif
                        >Билета е затворен</option>
                </select>
            </div>
            <div class="mt-4">
                <x-label for="reply" :value="__('Отговор')" />
                <textarea name="reply" class="w-full" rows="5"></textarea>
            </div>
            <x-button class="mt-4 w-full">
                {{ __('Отговори на билета') }}
            </x-button>
        </form>
    </div>
</div>