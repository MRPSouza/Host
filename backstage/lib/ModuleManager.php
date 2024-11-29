class ModuleManager {
    private static $modulesPath = __DIR__ . '/../modules/';
    
    public static function getAvailableModules() {
        if (!is_dir(self::$modulesPath)) {
            return [];
        }
        
        $modules = [];
        foreach (scandir(self::$modulesPath) as $item) {
            if ($item === '.' || $item === '..') continue;
            
            $modulePath = self::$modulesPath . $item;
            if (is_dir($modulePath) && file_exists($modulePath . '/module.php')) {
                $modules[$item] = true;
            }
        }
        
        return $modules;
    }
    
    public static function isModuleAvailable($moduleName) {
        return is_dir(self::$modulesPath . $moduleName) && 
               file_exists(self::$modulesPath . $moduleName . '/module.php');
    }
} 