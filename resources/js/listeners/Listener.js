import Echo from 'laravel-echo';
import { router } from '@inertiajs/vue3';
import { toast } from '@/components/ui/toast/use-toast';

export const Listener = () => {
    window.Echo.channel('newJobs')
        .listen('JobPosted', (e) => {
            toast('Event has been created', {
                description: 'Sunday, December 03, 2023 at 9:00 AM',
                action: {
                    label: 'Check',
                    onClick: () => router.visit(route('jobs.show', e.job_id)),
                },
            });
        });

};
