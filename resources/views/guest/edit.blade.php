@extends('layouts.template-mazer')
@section('content')
    <div class="page-heading">
        <h3>Update Data Guest</h3>
    </div>
    <div class="page-content">
        <div class="card">
            <div class="card-body col-12 col-md-8">
                <form action="{{ route('guests.update', $guest) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="image_data" id="imageData" value="">
                    <div class="mb-3">
                        <label class="form-label">Vehicle</label>
                        <select name="vehicles_id" class="form-control @error('vehicles_id') is-invalid @enderror">
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}"
                                    {{ old('vehicles_id', $guest->vehicles_id) == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->type }}
                                </option>
                            @endforeach
                        </select>
                        @error('vehicles_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <x-text-input name="name" label="Name" required :value="$guest->name" />
                    <x-text-input name="phone" label="Phone" required :value="$guest->phone" />
                    <div class="mb-3">
                        <label class="form-label">Destination</label>
                        <select name="destination" class="form-control @error('destination') is-invalid @enderror">
                            <option value="TU" {{ old('destination') == 'TU' ? 'selected' : '' }}>TU
                            </option>
                            <option value="Walikelas" {{ old('destination') == 'Walikelas' ? 'selected' : '' }}>Walikelas
                            </option>
                            <option value="Guru" {{ old('destination') == 'Guru' ? 'selected' : '' }}>Guru
                            </option>
                            <option value="Bendahara" {{ old('destination') == 'Bendahara' ? 'selected' : '' }}>Bendahara
                            </option>
                            <option value="Kurikulum" {{ old('destination') == 'Kurikulum' ? 'selected' : '' }}>Kurikulum
                            </option>
                            <option value="Kesiswaan" {{ old('destination') == 'Kesiswaan' ? 'selected' : '' }}>
                                Kesiswaan</option>
                            <option value="Kepala Sekolah" {{ old('destination') == 'Kepala Sekolah' ? 'selected' : '' }}>
                                Kepala Sekolah
                            </option>
                            <option value="Meeting" {{ old('destination') == 'Meeting' ? 'selected' : '' }}>Meeting
                            </option>
                            <option value="Lainnya" {{ old('destination') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                            </option>
                        </select>
                        @error('destination')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <x-text-input name="purpose" label="Purpose" required :value="$guest->purpose" />
                    <x-text-input type="time" name="checkin" label="Check In" required :value="$guest->checkin" />
                    <x-text-input type="time" name="checkout" label="Check Out" :value="$guest->checkout" />
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="Check Out" {{ old('status', $guest->status) == 'Check Out' ? 'selected' : '' }}>
                                Check Out</option>
                            <option value="Still Inside"
                                {{ old('status', $guest->status) == 'Still Inside' ? 'selected' : '' }}>Still Inside
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="md-3">
                        <div class="card-body">
                            <h3 class="card-title">Ambil Foto</h3>
                            <video id="cameraFeed" width="100%" height="auto" autoplay></video>
                            <canvas id="canvas" style="display: none;"></canvas>
                            <img id="capturedImage" src="#" alt="" style="max-width: 100%;">
                            <button onclick="capturePhoto()" class="btn btn-primary mt-1"> Simpan</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <script>
        async function setupCamera() {
            const constraints = {
                video: {
                    width: 400,
                    height: 300
                }
            };

            const video = document.getElementById('cameraFeed');
            try {
                const stream = await navigator.mediaDevices.getUserMedia(constraints);
                video.srcObject = stream;
            } catch (err) {
                console.error('Error accessing the camera:', err);
            }
        }

        function capturePhoto() {
            const video = document.getElementById('cameraFeed');
            const canvas = document.getElementById('canvas');
            const photo = document.getElementById('capturedImage');
            const imageDataInput = document.getElementById('imageData');

            canvas.width = 400;
            canvas.height = 300;
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

            const imageData = canvas.toDataURL('image/png');
            photo.setAttribute('src', imageData);
            photo.style.display = 'block';

            // Set data gambar ke input hidden
            imageDataInput.value = imageData;
        }

        setupCamera();
    </script>
@endsection
