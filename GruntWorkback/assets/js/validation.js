
function jobvalidate(){
	alert ("uhfidh")  
    if ((document.job_form.employer_name.value=="") || (document.job_form.employer_name.value=="")){
        alert("Please enter employer name.")
        return false
    }
    else if( (document.job_form.job_title.value=="") || (document.job_form.job_title.value=="") )
    {
    	 alert("Please enter job title.")
        return false
    }
    else if( (document.job_form.description.value=="") || (document.job_form.description.value=="") )
    {
    	 alert("Please enter description.")
        return false

    }
    else if( (document.job_form.job_type.value=="") || (document.job_form.job_type.value=="") )
    {
    	 alert("Please enter job type.")
        return false

    }
    else if( (document.job_form.duration.value=="") || (document.job_form.duration.value=="") )
    {
    	 alert("Please enter duration.")
        return false

    }
    else if( (document.job_form.est_amount.value=="") || (document.job_form.est_amount.value=="") )
    {
    	 alert("Please enter est amount.")
        return false

    }
    else if( (document.job_form.datetime.value=="") || (document.job_form.datetime.value=="") )
    {
    	 alert("Please enter datetime.")
        return false

    }
    else if( (document.job_form.location.value=="") || (document.job_form.location.value=="") )
    {
    	 alert("Please enter location.")
        return false

    }
    else if( (document.job_form.success_rate.value=="") || (document.job_form.success_rate.value=="") )
    {
    	 alert("Please enter success rate.")
        return false

    }
    else if( (document.job_form.bonus.value=="") || (document.job_form.bonus.value=="") )
    {
    	 alert("Please enter bonus.")
        return false

    }
    else if( (document.job_form.rating.value=="") || (document.job_form.rating.value=="") )
    {
    	 alert("Please enter rating.")
        return false

    }
    else
        return true

}
