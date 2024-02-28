@extends('layouts.general')

@section('profile')

<div class="container d-flex my-5">

    <h1 class="col-9">User Profile</h1>

    <div class="col-3 text-end">
        {{-- Boton para volver a SHOW --}}
        <a class="btn btn-dark mb-3" href="{{ url('/show') }}">
            <i class="fa-solid fa-rotate-left"></i>
        </a>

        <a class="btn btn-dark mb-3" href="{{ url('/user/orders') }}">
            <i class="fa-solid fa-file-invoice"></i>
        </a>

    </div>

</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Información del Usuario</h2>
            <ul>
                <li><strong>Nombre de usuario:</strong> {{ $user->username }}</li>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Teléfono:</strong> {{ $user->phone }}</li>
                <li><strong>Nombre:</strong> {{ $user->name }}</li>
            </ul>
            <button type="button" class="mt-3 btn btn-dark" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                Edit Profile
            </button>
        </div>
        <div class="col-md-6">
        <h2>Direcciones</h2>
    <select id="selectDireccion">
        @foreach($addresses as $address)
        <option value="{{ $address->id }}">{{ $address->street }}</option>
        @endforeach
    </select>

    
    @isset($addresses)
    @if($addresses->isNotEmpty())
    
        @foreach($addresses as $address)
        <div class="direccion" id="direccion{{ $address->id }}">
            
                <strong>Calle:</strong> {{ $address->street ?? 'unknown' }}<br>
                <strong>Ciudad:</strong> {{ $address->city ?? 'unknown' }}<br>
                <strong>País:</strong> {{ $address->country ?? 'unknown' }}<br>
                <strong>Código Postal:</strong> {{ $address->zipcode ?? 'unknown' }}<br>
            
            <button type="button" class="mt-3 btn btn-dark" data-bs-toggle="modal" data-bs-target="#editAddressModal{{ $address->id }}">
                Editar Dirección
            </button>

            <!-- Modal para editar dirección -->
            <div class="modal fade" id="editAddressModal{{ $address->id }}" tabindex="-1" aria-labelledby="editAddressModalLabel{{ $address->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h5 class="modal-title" id="editAddressModalLabel{{ $address->id }}">Edit Address</h5>
                            <button type="button" class="btn-close bg-danger rounded-5" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('address.edit') }}" method="POST">
                                @csrf

                                <input type="hidden" name="action" value="redirect_here">

                                <div class="form-group mb-3">
                                    <label for="street" class="fw-medium">Street:</label>
                                    <input type="text" name="street" class="form-control" value="{{ $address->street ?? 'unknown' }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="city" class="fw-medium">City:</label>
                                    <input type="text" name="city" class="form-control" value="{{ $address->city ?? 'unknown' }}">
                                </div>


                                <div class="form-group mb-3">
                                    <label for="country" class="fw-medium">Country:</label>
                                    <input type="text" name="country" class="form-control" value="{{ $address->country ?? 'unknown' }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="zipcode" class="fw-medium">Zipcode:</label>
                                    <input type="text" name="zipcode" class="form-control" value="{{ $address->zipcode ?? 'unknown' }}">
                                </div>
                        </div>
                        <div class="modal-footer justify-content-center bg-dark">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    

    @else
    <p>No hay información de dirección disponible.</p>
    @endif
    @else
    <p>No hay información de dirección disponible.</p>
    @endisset
    <button type="button" class="mt-3 btn btn-dark" data-bs-toggle="modal" data-bs-target="#addAddressModal">
        Agregar Dirección
    </button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.direccion').not(':first').hide();


        $('#selectDireccion').on('change', function() {
            var idSeleccionado = $(this).val();
            $('.direccion').hide(); // Oculta todas las direcciones
            $('#direccion' + idSeleccionado).show(); // Muestra solo la dirección seleccionada
        });
    });
</script>
    </div>
</div>

<!-- Modal para añadir dirección -->
<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="addAddressModalLabel">Add Address</h5>
                <button type="button" class="btn-close bg-danger rounded-5" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('address.save') }}" method="POST">
                    @csrf

                    <!-- Campo para indicar la acción -->
                    <input type="hidden" name="action" value="redirect_here">

                    <div class="form-group mb-3">
                        <label for="street" class="fw-medium">Street:</label>
                        <input type="text" name="street" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="city" class="fw-medium">City:</label>
                        <input type="text" name="city" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="country" class="fw-medium">Country:</label>
                        <input type="text" name="country" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="zipcode" class="fw-medium">Zipcode:</label>
                        <input type="text" name="zipcode" class="form-control">
                    </div>
            </div>
            <div class="modal-footer justify-content-center bg-dark">
                <button type="submit" class="btn btn-success">Add Address</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para editar perfil -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close bg-danger rounded-5" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.edit') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="username" class="fw-medium">Username:</label>
                        <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="fw-medium">Email:</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone" class="fw-medium">Phone:</label>
                        <input type="tel" name="phone" class="form-control" value="{{ $user->phone }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="name" class="fw-medium">Name:</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>
            </div>
            <div class="modal-footer justify-content-center bg-dark">
                <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
            </form>
        </div>
    </div>
</div>


@endsection