// document.querySelector('form').addEventListener('submit', function (event) {
//     let form = event.target;
//     let errors = false;

//     form.querySelectorAll('.error.js-error').forEach(el => el.remove());

//     function showError(input, message) {
//         let errorDiv = document.createElement('div');
//         errorDiv.className = 'error js-error';
//         errorDiv.style.color = 'red';
//         errorDiv.style.fontSize = '13px';
//         errorDiv.style.display = 'inline-block';
//         errorDiv.style.marginLeft = '8px';
//         errorDiv.textContent = message;

//         if (input.type === 'radio' || input.type === 'checkbox') {
//             input.insertAdjacentElement('afterend', errorDiv);
//         } else {
//             input.parentNode.insertBefore(errorDiv, input.nextSibling);
//         }
//     }

//     let name = form.name.value.trim();
//     if (!name || !/^[a-zA-Z\s]+$/.test(name)) {
//         showError(form.name, 'Please enter a valid name (only letters and spaces).');
//         errors = true;
//     }
//     let email = form.email.value.trim();
//     if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
//         showError(form.email, 'Please enter a valid email address.');
//         errors = true;
//     }


//     let age = form.age.value.trim();
//     if (!age || isNaN(age) || Number(age) <= 0) {
//         showError(form.age, 'Please enter a valid age.');
//         errors = true;
//     }

//     let password = form.password.value;
//     if (!password || password.length < 6) {
//         showError(form.password, 'Password must be at least 6 characters long.');
//         errors = true;
//     }

//     let mobile = form.mobile.value.trim();
//     if (!mobile || !/^\d{10}$/.test(mobile)) {
//         showError(form.mobile, 'Please enter a valid 10-digit mobile number.');
//         errors = true;
//     }


//     let genderChecked = [...form.gender].some(radio => radio.checked);
//     if (!genderChecked) {
//         showError(form.gender[form.gender.length - 1], 'Please select a gender.');
//         errors = true;
//     }


//     if (!form.designation.value || form.designation.value === "Select Designation") {
//         showError(form.designation, 'Please select a designation');
//         errors = true;
//     }

//     if (!form.position.value || form.position.value === "Select Position") {
//         showError(form.position, 'Please select a position.');
//         errors = true;
//     }


//     if (!form.employee.value || form.employee.value === "select employee") {
//         showError(form.employee, 'Please select an employee role.');
//         errors = true;
//     }

//     let hobbiesChecked = [...form.querySelectorAll('input[name="hobbies[]"]:checked')];
//     if (hobbiesChecked.length === 0) {
//         let hobbies = form.querySelectorAll('input[name="hobbies[]"]');
//         showError(hobbies[hobbies.length - 1], 'Please select at least one hobby.');
//         errors = true;
//     }

//     if (errors) {
//         event.preventDefault();
//     }


// });


$(document).ready(function(){
    $.validator.addMethod("requiredNumber",function(value,element){
        return this.optional(element) || /^[6-9]\d{9}$/.test(value);
    },"mobile number must start with 6,7,8 or 9 and be 10 digits long ");

    $.validator.addMethod("requireOneHobby",function(value,element){
        return $("input[name='hobbies[]']:checked").length>0;
    },"Please select at least one hobby.");

    $.validator.addMethod("pattern",function(value,element,param){
        if(this.optional(element)){
        return true;
    }
return param.test(value);
},"Invalid format.");
    $("#EmpForm").validate({
        errorElement: "div",
        rules:{
            name:{
                required:true,
                pattern: /^[a-zA-Z\s]+$/
            },
            email:{
                required: true,
                email: true
            },
            age:{
                required:true,
                number: true,
                min:1
            },
            password:{
                required:true,
                minlength: 6
            },
            mobile:{
                required: true,
                digits:true,
                minlength:10,
                maxlength:10,
                requiredNumber: true
            },
            gender:{
                required:true
            },
            designation:{
                required:true
            },
            position:{
                required:true
            },
            employee:{
                required:true
            },
            'hobbies[]':{
                requireOneHobby: true,
                required: true,
            }
        },
        messages:{
            name:{
                required:"Please enter your name",
                pattern:"Only letters and spaces are allowed"
            },
            email:{
                required:"Please enter your email address",
                email: "Please enter a valid email address"
            },
            age:{
                required: "Please enter your age",
                Number: "Please enter a valid number",
                min:"Age must at least 1"
            },
            password:{
                required:"Please enter your password",
                minlength:"Password must be at least 6 characters"
            },
            mobile:{
                required: "Please enter your mobile number",
                digits: "Only digits are allowed",
                minlength: "Mobile number must be exactly 10 digits",
                maxlength: "Mobile number must be exactly 10 digits",
                requiredNumber:"Mobile number start with 6,7,8 or 9"
            },
            gender:{
                required: "Please select your gender"
            },
            designation:{
                required: "Please select designation"
            },
            position:{
                required:"Please select position"
            },
            employee:{
                required:"Please select employee role"
            },
            'hobbies[]':{
                requireOneHobby:"Please select at least one hobby"
            }
        },
        errorPlacement: function(error,element){
            if(element.attr("type")==="checkbox"){
                error.insertAfter(element.closest('div.hobbies-group'));
            }else if(element.attr("type")==="radio"){
                error.insertAfter(element.closest('div.gender-group'));
            }else if(element.is("select")){
                error.insertAfter(element);
            }else{
                error.insertAfter(element);
            }
        }
    });
});