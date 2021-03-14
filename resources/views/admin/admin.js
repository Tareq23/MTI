
$(document).ready(function(){
    let sideNavToggleCount = 0;
    $("#menuBarBtn").click(function(){
        sideNavToggleCount++;
        if(sideNavToggleCount%2==1){
            $("#sideNav").removeClass("d-none");
        }
        else{
            $("#sideNav").addClass("d-none");
        }
    })
})