@extends('layouts.app')

@section('title', 'Editando'.$event->title)

@section('content')
        <div class="col-md-6 offset-md-3">
            <h1>Crie o seu Evento</h1>
            <form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="image">Imagem do Evento:</label>
                    <input type="file" class="form-control-file" name="image" id="image" >
                    <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-preview">
                </div>
                <div class="form-group mb-3">
                    <label for="title">Evento:</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Nome do Evento" value="{{ $event->title }}">
                </div>
                <div class="form-group mb-3">
                    <label for="date">Data:</label>
                    <input type="date" class="form-control" name="date" id="date"  value="{{ $event->date->format('Y-m-d') }}">
                </div>
                <div class="form-group mb-3">
                    <label for="city">Cidade:</label>
                    <input type="text" class="form-control" name="city" id="city" placeholder="Local do Evento" value="{{ $event->city }}">
                </div>
                <div class="form-group mb-3">
                    <label for="private">O evento é Privado</label>
                    <select name="private" id="private" class="form-control">
                        <option value="0">NÃO</option>
                        <option value="1"  {{ $event->private == 1 ? "selected ='selected'" : ""  }}>SIM</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="discription">Descrição:</label>
                    <textarea class="form-control" name="discription" id="discription" placeholder="Descrição">{{ $event->discription }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="discription">Adicione items de infraestrutura:</label>
                    <div class="form-group">
                        <input type="checkbox" name="items[]" id="" value="Cadeiras"> Cadeiras
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="items[]" id="" value="Palco"> Palco
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="items[]" id="" value="Cerveja Grátis"> Cerveja Grátis
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="items[]" id="" value="Open Food"> Open Food
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="items[]" id="" value="Brindes"> Brindes
                    </div>
                </div>
                 <input type="submit" class="btn btn-primary" value="Criar Evento">
            </form>
        </div>
@endsection