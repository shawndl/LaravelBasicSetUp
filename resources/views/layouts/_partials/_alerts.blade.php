@if (session()->has('success'))
    <alert-message :type="'success'" :message="'{{ session('success') }}'" :title="'Success'">

    </alert-message>
@endif

@if (session()->has('error'))
    <alert-message :type="'danger'" :message="'{{ session('error') }}'" :title="'Error'">

    </alert-message>
@endif

