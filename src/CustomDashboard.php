<?php

namespace NovaBi\NovaDashboardManager;

use DigitalCreative\NovaDashboard\Dashboard;
use NovaBi\NovaDashboardManager\Views\CustomView;
use NovaBi\NovaDashboardManager\Models\Dashboard as DashboardModel;

class CustomDashboard extends Dashboard
{

    private DashboardModel $model;

    /**
     * @param DashboardModel $dashboards
     */
    public function __construct(DashboardModel $dashboards)
    {
        $this->model = $dashboards;
    }

    public static string $title = 'Dashboard';

    public function title(): string
    {
        return "Dashboard";
        return $this->model->name;
    }


    public static function humanize($value = null): string
    {
        return 'test';
    }


    /**
     * Get the ID for the resource.
     *
     * @return int
     */
    public function resourceId(): int
    {
        return $this->model->id;
    }

    /**
     * Get the URI for the resource.
     *
     * @return string
     */
    public function resourceUri(): string
    {
        return "custom-dashboard-{$this->model->id}";
    }

    public function setDashboard(string $dashboardKey): self
    {
        $this->dashboardKey = $this->resourceUri();
        return $this;
    }
    public function uriKey(): string
    {
        return $this->resourceUri();
    }
    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public function resourceLabel(): string
    {
        return $this->model->name;
    }

    public function views(): array
    {
        /**
         * Here you have access to $this->model ... so you can build any custom view dynamically...
         * you can also pass the same model down to the custom views to build the widgets dynamically too
         */

        // closure: ->editable(fn() => false);
        return [
            CustomView::make($this->model)->editable(
                $this->model->DashboardEditable
            )
        ];
    }

    /**
     * return dasbhoard model
     * 
     * @return DashboardModel
     */
    
    public function model() {
        return $this->model;
    }    
    
    // todo
    // make configurable
    // https://vue-responsive-dash.netlify.app/api/#props
    public function options(): array
    {
        return [
            'expandFilterByDefault' => $this->model->ExpandFilterByDefault,
            'enableAddWidgetButton' => $this->model->enableAddWidgetButton,
            'displayScreenshotButton' => $this->model->showSaveScreenshotButton,
            'grid' => [
                [
                    'breakpoint' => 'sm',
                    'breakpointWidth' => 0,
                    'compact' => $this->model->GridCompact,
                    'numberOfCols' => 1,
                    'minRowHeight' => 120,
                    'maxRowHeight' => 120
                ],

                [
                    'breakpoint' => 'xl',
                    'breakpointWidth' => 600,
                    'compact' => $this->model->GridCompact,
                    'numberOfCols' => 12,//(int)$this->model->GridNumberOfColumns,
                    'maxColWidth' => 500,
                    'minColWidth' => 80,
                    'minRowHeight' => 120,
                    'maxRowHeight' => 120
                ],
                /*
                [
                    'breakpoint' => 'sm',
                    'breakpointWidth' => 50,
                    'compact' => $this->model->GridCompact,
                    'numberOfCols' => 1,
                    'debug' => true
                ]
                */
            ]
        ];
    }

}
