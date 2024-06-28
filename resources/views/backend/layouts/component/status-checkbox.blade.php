@include('backend.layouts.component.checkbox',['name' => $name, 'value' => '0', 'title' => 'Good', 'checked' => $value == 0 ? 'checked' : ''])

@include('backend.layouts.component.checkbox',['name' => $name, 'value' => '1', 'title' => 'Medium', 'checked' => $value == 1 ? 'checked' : ''])

@include('backend.layouts.component.checkbox',['name' => $name, 'value' => '2', 'title' => 'Bad', 'checked' => $value == 2 ? 'checked' : ''])
