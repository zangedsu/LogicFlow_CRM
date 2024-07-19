<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
    <form wire:submit="create">
        <input name="name" wire:model.blur="name" placeholder="Имя клиента">
        @error('name')<div class="bg-red-900">{{ $message }}</div>@enderror
        <input name="phone" wire:model.blur="phone" placeholder="Номер телефона">
        @error('phone')<div class="bg-red-900">{{ $message }}</div>@enderror
        <input name="site" wire:model.blur="site" placeholder="URL сайта">
        @error('site')<div class="bg-red-900">{{ $message }}</div>@enderror
        <button class="text-white" type="submit">Создать</button>
    </form>
</div>
