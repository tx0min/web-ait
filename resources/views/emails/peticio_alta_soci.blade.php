@component('mail::message')
# Petició Alta de soci a l'AIT

- Nom: **{{ $soci->first_name }}**
- Cognoms: **{{ $soci->last_name ?? '-' }}**
- Email: **[{{ $soci->email }}](mailto:{{ $soci->email }})**
- Telèfon: **{{ $soci->telefon ?? '-'}}**
- Data naixement: **{{ $soci->data_naixement }}**
- Localitat: **{{ $soci->localitat ?? '-'}}**
- Adreca: **{{ $soci->adreca ?? '-'}}**
- Disciplines: 
@foreach($soci->disciplines as $disciplina)
    - **{{$disciplina->name}}**
@endforeach

@endcomponent