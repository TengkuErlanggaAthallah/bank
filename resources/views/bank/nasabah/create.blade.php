@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Tambah Nasabah</h1>
    <form action="{{ route('nasabah.store') }}" method="POST" onsubmit="return validateForm()">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required placeholder="Masukkan nama lengkap" value="{{ old('nama') }}">
            @error('nama')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>No KTP</label>
            <input type="text" name="no_ktp" class="form-control" required placeholder="16 digit angka" pattern="\d{16}" title="No KTP harus 16 digit angka" value="{{ old('no_ktp') }}">
            @error('no_ktp')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" id="address" name="alamat" class="form-control" required placeholder="Masukkan alamat lengkap" autocomplete="off" value="{{ old('alamat') }}">
            @error('alamat')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div id="addressSuggestions" class="list-group" style="display: none;"></div>
        </div>
        <div class="mb-3">
            <label>No Telepon</label>
            <div class="input-group">
                <select id="countryCode" class="form-select" name="country_code" required>
                    <option value="+62">+62 (Indonesia)</option>
                    <option value="+1">+1 (USA)</option>
                    <option value="+44">+44 (UK)</option>
                    <!-- Add more country codes as needed -->
                </select>
                <input type="tel" name="no_telepon" class="form-control" required placeholder="8123456789" title="Nomor telepon harus diawali dengan 8 dan diikuti oleh 10 digit" value="{{ old('no_telepon') }}">
                @error('no_telepon')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places"></script>
<script>
function validateForm() {
    const noKTP = document.querySelector('input[name="no_ktp"]').value;
    const noTelepon = document.querySelector('input[name="no_telepon"]').value;

    // Validate No KTP (must be 16 digits)
    if (noKTP.length !== 16 || isNaN(noKTP)) {
        alert("No KTP harus 16 digit dan hanya angka.");
        return false;
    }

    return true; // If all validations pass
}

// Google Maps Autocomplete
function initAutocomplete() {
    const addressInput = document.getElementById('address');
    const suggestionsContainer = document.getElementById('addressSuggestions');

    const autocomplete = new google.maps.places.Autocomplete(addressInput);
    autocomplete.addListener('place_changed', function() {
        const place = autocomplete.getPlace();
        if (place) {
            addressInput.value = place.formatted_address;
        }
    });

    addressInput.addEventListener('input', function() {
        const query = addressInput.value;
        if (query.length > 0) {
            suggestionsContainer.style.display = 'block';
        } else {
            suggestionsContainer.style.display = 'none';
        }
    });
}

window.onload = initAutocomplete;
</script>
@endsection
@endsection