<style type="text/css">
    optgroup[label] {
        background: #dc8b92;
        color: #000;
    }
    optgroup option{
        background: #FFFFFF;
        color: #000;
    }
</style>
<style>
    #loader {
        border: 12px solid #f3f3f3;
        border-radius: 50%;
        border-top: 12px solid #444444;
        width: 70px;
        height: 70px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        100% {
            transform: rotate(360deg);
        }
    }

    .center {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
    }
</style>
<div class="container">
    <div id="loader" class="center"></div>
    <div class="card card-danger">
        <div class="card-header">
            <?php
            $rptName='';
            if($report_type=='ItemSummery'){
                $rptName='Item Summery';
            }
            ?>
            <h3 class="card-title"><?=$$rptName?> Report for Sales Rep: <?=$user?></h3>
        </div>
        <div class="card-body">
            I would appreciate if you could take few minutes and support to success this survey by respond to this questionnaire. Kindly note that, your response will be treated as strictly confidential<br> ඔබට විනාඩි කිහිපයක් ගත කර මෙම ප්‍රශ්නාවලියට ප්‍රතිචාර දැක්වීමෙන් මෙම සමීක්ෂණය සාර්ථක කර ගැනීමට සහය දිය හැකි නම් මම අගය කරමි. ඔබගේ ප්‍රතිචාරය දැඩි ලෙස රහසිගත ලෙස සලකනු ලබන බව කරුණාවෙන් සලකන්න
            .
        </div>
    </div>
</div>
