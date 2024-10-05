<x-action-section>
    <x-slot name="title">
        {{ __('Удаление команды') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Полностью удалить все данные команды') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __('При удалении команды все данные будут безвозвратно утеряны') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                {{ __('Удалить команду') }}
            </x-danger-button>
        </div>

        <!-- Delete Team Confirmation Modal -->
        <x-confirmation-modal wire:model.live="confirmingTeamDeletion">
            <x-slot name="title">
                {{ __('Удалить команду') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Вы уверены, что хотите удалить команду и все данные (проекты, задачи, и т. д.)? Всю удаленную информацию восстановить не получится.') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                    {{ __('Отмена') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteTeam" wire:loading.attr="disabled">
                    {{ __('Удалить команду') }}
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>
    </x-slot>
</x-action-section>
