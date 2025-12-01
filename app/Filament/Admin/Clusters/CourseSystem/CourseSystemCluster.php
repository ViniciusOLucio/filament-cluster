<?php

namespace App\Filament\Admin\Clusters\CourseSystem;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Support\Icons\Heroicon;

class CourseSystemCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static ?string $navigationLabel = 'Sistema de Cursos';

    protected static ?string $slug = 'sistema-de-cursos';

    protected static ?string $clusterBreadcrumb = 'Sistema de Cursos';

    protected static string|\UnitEnum|null $navigationGroup = 'Sistema de Cursos';


}
