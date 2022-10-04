import InstallExternalComposerDependencies from "./components/Tools/InstallExternalComposerDependencies";
import RemoveExternalComposerDependencies from "./components/Tools/RemoveExternalComposerDependencies";

Statamic.booting(() => {
    Statamic.$components.register("install-external-composer-dependencies", InstallExternalComposerDependencies);
    Statamic.$components.register("remove-external-composer-dependencies", RemoveExternalComposerDependencies);
});
