<?php

namespace App\Livewire\Concerns;

trait WithToastr
{
    protected function toast($message, $type = 'info', $redirect = false)
    {
        if ($redirect) {
            session()->flash('toastr', [
                'type' => $type,
                'message' => $message,
            ]);
        } else {
            $this->dispatch('notify', type: $type, message: $message);
        }
    }

    /**
     * Display a success toast notification
     */
    public function toastSuccess($message, $redirect = false)
    {
        $this->toast($message, 'success', $redirect);
    }

    /**
     * Display an error toast notification
     */
    public function toastError($message, $redirect = false)
    {
        $this->toast($message, 'error', $redirect);
    }

    /**
     * Display an info toast notification
     */
    public function toastInfo($message, $redirect = false)
    {
        $this->toast($message, 'info', $redirect);
    }

    /**
     * Display a warning toast notification
     */
    public function toastWarning($message, $redirect = false)
    {
        $this->toast($message, 'warning', $redirect);
    }

    /**
     * Display a toast and redirect
     */
    public function toastAndRedirect($message, $route, $type = 'success')
    {
        $this->toast($message, $type, true);
        return redirect()->route($route);
    }

    /**
     * Display success toast and redirect
     */
    public function toastSuccessAndRedirect($message, $route)
    {
        return $this->toastAndRedirect($message, $route, 'success');
    }

    /**
     * Display error toast and redirect
     */
    public function toastErrorAndRedirect($message, $route)
    {
        return $this->toastAndRedirect($message, $route, 'error');
    }
}