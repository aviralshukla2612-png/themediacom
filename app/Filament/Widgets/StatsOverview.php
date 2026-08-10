<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Service;
use App\Models\Campaign;
use App\Models\Gallery;
use App\Models\Inquiry;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $newInquiries = Inquiry::where('status', 'New')->count();

        return [
            Stat::make('Total Services', Service::count())
                ->description('Active services on the website')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('primary'),

            Stat::make('Total Campaigns', Campaign::count())
                ->description('Campaign case studies published')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color('primary'),

            Stat::make('Gallery Assets', Gallery::count())
                ->description('Images & videos in gallery')
                ->descriptionIcon('heroicon-m-photo')
                ->color('primary'),

            Stat::make('Quote Requests', Inquiry::count())
                ->description($newInquiries . ' new / unread')
                ->descriptionIcon('heroicon-m-inbox-arrow-down')
                ->color($newInquiries > 0 ? 'danger' : 'primary'),
        ];
    }
}
