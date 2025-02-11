<div class="hidden lg:block lg:w-1/4 space-y-5">
    <x-dashboard.block blockTitle="Menu">
        <x-dashboard.link linkRoute='admin.dashboard' linkName='Dashboard' />
        <x-dashboard.link linkRoute='profile.user' linkName='My Account' />
        <x-dashboard.link linkRoute='logout.user' linkName='Logout' />
    </x-dashboard.block>
    <x-dashboard.block blockTitle="Inventory">
        <x-dashboard.link linkRoute='add.crane.inventory' linkName='Add New Crane' />
        <x-dashboard.link linkRoute='show.inventory' linkName='Show Inventory' />
        <x-dashboard.link linkRoute='add.part.inventory' linkName='Add Part' />
        <x-dashboard.link linkRoute='add.equipment.inventory' linkName='Add Equipment' />
        {{-- <x-dashboard.block.link route='add.crane.categories' linkText='Add Crane Categories' />
        <x-dashboard.block.link route='add.part.categories' linkText='Add Part Categories' /> --}}
    </x-dashboard.block>
    <x-dashboard.block blockTitle='Business Tools'>
        <x-dashboard.link linkRoute='quotes.home' linkName='Show Quotes' />
        <x-dashboard.link linkRoute='billing.home' linkName='Billing' />
        {{-- <x-dashboard.block.link route='quotes.view' linkText='View Quote' /> --}}
    </x-dashboard.block>
    <x-dashboard.block blockTitle="Website Management">
        <x-dashboard.link linkRoute='dashboard.website.manage' linkName='Maintenance Mode' />
        <x-dashboard.link linkRoute='dashboard.website.database' linkName='Database Maintenance' />
        <x-dashboard.link linkRoute='dashboard.website.users' linkName='User Management' />
        <x-dashboard.link linkRoute='dashboard.website.settings' linkName='Website Settings' />

    </x-dashboard.block>

</div>