<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"//XML header
?>
<?php
printf($xmltemplate,
h($surveyGroup['SurveyGroup']['survey_group_id']),
h($surveyGroup['SurveyGroup']['name']),
h($surveyGroup['SurveyGroup']['date']),
h($surveyGroup['SurveyGroup']['type']),
h($surveyGroup['SurveyGroup']['location']),
h($surveyGroup['SurveyGroup']['instructor'])
);
?>
