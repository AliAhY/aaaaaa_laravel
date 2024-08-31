@extends('layout')  

@section('main')  
    <div class="container mt-5">  
        <h1 class="text-center">المراحل</h1>  

        <div class="mb-4">  
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPhaseModal">  
                إضافة مرحلة <i class="fa-solid fa-plus"></i>  
            </button>  
        </div>  

        <div class="row" id="stagesContainer">  
            @foreach ($stages as $stage)  
                <div class="col-md-4 mb-4 stage-item" data-stage-id="{{ $stage->id }}">  
                    <div class="card">  
                        <div class="card-header">  
                            <h4>{{ $stage->phaseName }}</h4>  
                        </div>  
                        <div class="card-body">  
                            <h5>{{ $stage->descriptaion }}</h5>  
                            <h6>الدورات:</h6>  
                            <ul>  
                                <li>دورة 1</li>  
                                <li>دورة 2</li>  
                            </ul>  
                        </div>  
                    </div>  
                </div>  
            @endforeach  
        </div>  
    </div>  

    <!-- نموذج إضافة مرحلة -->  
    <div class="modal fade" id="addPhaseModal" tabindex="-1" aria-labelledby="addPhaseModalLabel" aria-hidden="true">  
        <div class="modal-dialog">  
            <div class="modal-content">  
                <div class="modal-header">  
                    <h5 class="modal-title" id="addPhaseModalLabel">إضافة مرحلة جديدة</h5>  
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
                </div>  
                <div class="modal-body">  
                    <form id="addPhaseForm">  
                        <div class="mb-3">  
                            <label for="phaseName" class="form-label">اسم المرحلة</label>  
                            <input type="text" class="form-control" name="phaseName" id="phaseName" required>  
                        </div>  

                        <div class="mb-3">  
                            <label for="courses" class="form-label">وصف المرحلة</label>  
                            <input type="text" class="form-control" name="phaseDesc" id="phaseDesc" required>  
                        </div>  
                    </form>  
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>  
                    <button type="button" class="btn btn-primary" id="submitPhaseButton">إضافة المرحلة</button>  
                </div>  
            </div>  
        </div>  
    </div>  

    <script>  
        document.getElementById('submitPhaseButton').addEventListener('click', function() {  
            // اجمع البيانات من النموذج  
            var phaseName = document.getElementById('phaseName').value;  
            var phaseDesc = document.getElementById('phaseDesc').value;  

            // إرسال البيانات باستخدام XMLHttpRequest  
            var xhr = new XMLHttpRequest();  
            xhr.open("POST", "{{ route('stages.store') }}", true);  
            xhr.setRequestHeader("Content-Type", "application/json");  
            xhr.setRequestHeader("X-CSRF-TOKEN", '{{ csrf_token() }}');  

            // عند نجاح الطلب  
            xhr.onload = function() {  
                if (xhr.status === 200) {  
                    var response = JSON.parse(xhr.responseText);  

                    // إغلاق الـ modal  
                    var modal = bootstrap.Modal.getInstance(document.getElementById('addPhaseModal'));  
                    modal.hide();  

                    // إظهار رسالة النجاح  
                    Swal.fire({  
                        icon: 'success',  
                        title: 'نجاح!',  
                        text: response.success,  
                        confirmButtonText: 'موافق'  
                    });  

                    // إضافة المرحلة الجديدة إلى الصفحة دون تحديث  
                    var newStageHTML = `  
                        <div class="col-md-4 mb-4 stage-item" data-stage-id="${response.stage.id}">  
                            <div class="card">  
                                <div class="card-header">  
                                    <h4>${phaseName}</h4>  
                                </div>  
                                <div class="card-body">  
                                    <h5>${phaseDesc}</h5>  
                                    <h6>الدورات:</h6>  
                                    <ul>  
                                        <li>دورة 1</li>  
                                        <li>دورة 2</li>  
                                    </ul>  
                                </div>  
                            </div>  
                        </div>`;  
                    
                    document.getElementById('stagesContainer').insertAdjacentHTML('beforeend', newStageHTML);  
                    
                    // مسح القيم في المدخلات  
                    document.getElementById('addPhaseForm').reset();  

                } else {  
                    // معالجة الأخطاء في حالة عدم النجاح  
                    var errorResponse = JSON.parse(xhr.responseText);  
                    Swal.fire({  
                        icon: 'error',  
                        title: 'خطأ!',  
                        text: errorResponse.error,  
                        confirmButtonText: 'موافق'  
                    });  
                }  
            };  

            // إرسال البيانات إلى السيرفر  
            xhr.send(JSON.stringify({  
                phaseName: phaseName,  
                phaseDesc: phaseDesc  
            }));  
        });  
    </script>  
@endsection