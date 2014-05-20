function change_day(name)
{
    document.getElementById('day_'+anc_day).className = 'day_0 day';
    document.getElementById('day_'+anc_day+'_2').className = 'day_2 daybottom';
    document.getElementById('day_'+name).className = 'day_1 day';
    document.getElementById('day_'+name+'_2').className = 'day_3 daybottom';
    document.getElementById('content_day_'+anc_day).style.display = 'none';
    document.getElementById('content_day_'+name).style.display = 'block';
    anc_day = name;
}