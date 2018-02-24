<?php
class Membership_Reports_Controller extends Membership_Base_Controller {

    public function createReport(Rsc_Http_Parameters $parameters) {

        $report = $parameters->get('message');
        $reportedId = $parameters->get('objectId');
        $type = $parameters->get('type');

        $reportsModel = $this->getModel('reports');
        $currentUserId = get_current_user_id();

        $activityModel = $this->getModel('activity', 'activity');

        if ($type !== 'user') {
            $activity = current($activityModel->getActivityById($reportedId, $currentUserId, array('status' => 'active')));

            if (!$activity) {
                return $this->response(
                    'ajax',
                    array(
                        'success' => false,
                        'status' => 403,
                        'message' => $this->translate('Report was not sent. Report content not found.')
                    )
                );
            }
        }

        $reportId = $reportsModel->create($currentUserId, $reportedId, $type, $report);

        if (!$reportId) {
            return $this->response(
                'ajax',
                array(
                    'success' => false,
                    'status' => 403,
                    'message' => $this->translate('Report was not sent.')
                )
            );
        }

        return $this->response(
            'ajax',
            array(
                'success' => true
            )
        );
    }

    public function setStatus(Rsc_Http_Parameters $parameters) {

        $data = $parameters->get('data');
        $reportId = $data['id'];
        $status = $data['status'];
        $reportsModel = $this->getModel();
        $reportsModel->update($reportId, $status);

        $error = $reportsModel->getError();

        if ($error) {
            return $this->response('ajax', array(
                'success' => false,
                'error' => $error
            ));
        }

        return $this->response('ajax', array(
            'success' => true
        ));
    }
}