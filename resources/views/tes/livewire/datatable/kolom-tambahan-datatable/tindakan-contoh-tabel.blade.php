<button type="button" 
class="text-white bg-blue-500 rounded-lg text-sm px-2 py-2 focus:ring-4 focus:outline-none hover:bg-blue"
data-modal-toggle="contohModal" 
wire:click="$emit('ubahTest','{{$nama}}')">Nama</button>

<button type="button" 
class="text-white bg-blue-500 rounded-lg text-sm px-2 py-2 focus:ring-4 focus:outline-none hover:bg-blue"
data-modal-toggle="contohModal" 
wire:click="$emit('edit','{{$nrk}}')">Edit</button>
