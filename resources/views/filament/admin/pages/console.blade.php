<x-filament-panels::page>
    <form method="POST" action="{{ route('rcon.sendCommand') }}">
        @csrf

        <div class="login-center">
            <label style="font-weight: 500; font-size: .875rem;">Send rcon command</label><br>
            <input style="margin-top: 10px; border-radius: 10px; border: 1px solid #71717a73; padding-bottom: .375rem; padding-top: .375rem; background-color: hsla(0, 0%, 100%, 0.05);" type="text" name="command" placeholder="Send rcon command..." /><br>
            <button style="border-radius: 10px; background: #599bfa;padding-bottom: .5rem; padding-top: .5rem; padding-left: .75rem; padding-right: .75rem; font-weight: 600; font-size: .875rem; margin-top: 20px;" type="submit">Send</button>
        </div>
    </form>
</x-filament-panels::page>
