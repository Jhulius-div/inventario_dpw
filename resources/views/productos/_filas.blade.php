@forelse ($productos as $prod)
    <tr>
        <td class="text-center">{{ $prod->idproducto }}</td>
        <td>{{ $prod->producto }}</td>
        <td>{{ $prod->categoria }}</td>
        <td>S/ {{ number_format($prod->precio, 2) }}</td>
        <td>{{ $prod->stock }}</td>
        <td class="text-center">
            <button type="button" class="btn btn-warning btn-sm btn-editar"
                    data-id="{{ $prod->idproducto }}"
                    data-producto="{{ $prod->producto }}"
                    data-categoria="{{ $prod->categoria }}"
                    data-precio="{{ $prod->precio }}"
                    data-stock="{{ $prod->stock }}">Edit</button>
            <button type="button" class="btn btn-danger btn-sm btn-eliminar"
                    data-id="{{ $prod->idproducto }}"
                    data-producto="{{ $prod->producto }}">Eliminar</button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center">No hay productos registrados</td>
    </tr>
@endforelse
